<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function hfAnswer(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:2000',
        ]);

        $debug = $request->boolean('debug');

        $hfToken = config('services.huggingface.token');
        $hfModel = config('services.huggingface.model', 'HuggingFaceTB/SmolLM3-3B:hf-inference');

        if (empty($hfToken)) {
            Log::error('HF Token fehlt (services.huggingface.token).');

            return response()->json([
                'answer' => 'Der AI-Service ist aktuell nicht konfiguriert. Bitte später erneut versuchen.',
            ], 500);
        }

        $question = trim((string) $validated['question']);

        // ✅ HARD LOCK: Antasus ist deutsch – wenn Frage deutsch wirkt, erzwingen wir Deutsch.
        // (Du wolltest: "Antworten müssen auf deutsch sein")
        // -> Wenn du später wirklich multilingual willst, kann man das wieder öffnen.
        $lang = 'de';

        // Antwortsprache strikt
        $languageInstruction = 'Antworte ausschließlich auf Deutsch.';

        // Off-topic Satz (Deutsch)
        $offTopic = 'Wir beantworten gerne alle Fragen rund um Glasfaser, FTTH und Hausanschlüsse. Für andere Themen wenden Sie sich bitte an die zuständige Stelle.';

        $systemPrompt = <<<EOT
Du bist ein kompetenter, professioneller Glasfaserbau-, Glasfaser-Tiefbau- und Glasfaser-Hausanschluss-Experte von ANTASUS Infra.
Beantworte ausschließlich Fragen zu Glasfaser, FTTx, FTTH, FTTB, Tiefbau, Hausanschlüssen, Projektmanagement im Glasfaserbau und verwandten Themen.
Alle Antworten beziehen sich auf ANTASUS Infra und deren Leistungen.

WICHTIG:
- {$languageInstruction}
- Antworte kurz, professionell, klar strukturiert (gerne Bulletpoints).
- KEINE internen Gedanken, KEIN "<think>", KEINE Meta-Kommentare.
- Wenn die Frage außerhalb des Bereichs liegt, antworte exakt:
"{$offTopic}"
EOT;

        try {
            $response = Http::withToken($hfToken)
                ->acceptJson()
                ->asJson()
                ->timeout(60)
                ->retry(3, 900, function ($exception) {
                    $status = optional($exception->response)->status();

                    return in_array($status, [429, 503, 504], true);
                })
                ->post('https://router.huggingface.co/v1/chat/completions', [
                    'model' => $hfModel,
                    'stream' => false,
                    'temperature' => 0.2,
                    'max_tokens' => 260,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $question],
                    ],
                ]);
        } catch (\Throwable $e) {
            Log::error('HF Request Exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json(['answer' => 'Der AI-Service ist aktuell nicht erreichbar. Bitte später erneut versuchen.'], 502);
        }

        $body = (string) $response->body();

        if (! $response->successful()) {
            Log::error('HF Chat API Fehler', [
                'status' => $response->status(),
                'body' => $body,
            ]);

            return response()->json(['answer' => 'Der AI-Service ist aktuell ausgelastet oder nicht erreichbar. Bitte versuchen Sie es in wenigen Minuten erneut.'], 502);
        }

        $decoded = json_decode($body, true);

        if (! is_array($decoded)) {
            Log::error('HF Response konnte nicht als JSON dekodiert werden', [
                'status' => $response->status(),
                'body_head' => mb_substr($body, 0, 500),
            ]);

            if ($debug) {
                return response()->json([
                    'ok' => false,
                    'reason' => 'json_decode_failed',
                    'status' => $response->status(),
                    'body' => $body,
                ], 200);
            }

            return response()->json(['answer' => 'Der AI-Service hat eine unerwartete Antwort geliefert. Bitte später erneut versuchen.'], 502);
        }

        $raw =
            data_get($decoded, 'choices.0.message.content')
            ?? data_get($decoded, 'choices.0.delta.content')
            ?? data_get($decoded, 'choices.0.text')
            ?? data_get($decoded, 'generated_text')
            ?? data_get($decoded, '0.generated_text');

        $errMsg = data_get($decoded, 'error') ?? data_get($decoded, 'message');

        if ($debug) {
            return response()->json([
                'ok' => true,
                'model' => $hfModel,
                'question' => $question,
                'extracted_raw' => $raw,
                'error_field' => $errMsg,
                'finish_reason' => data_get($decoded, 'choices.0.finish_reason'),
                'decoded' => $decoded,
            ], 200);
        }

        if (! is_string($raw) || trim($raw) === '') {
            Log::warning('HF Antwort ohne content/raw', [
                'model' => $hfModel,
                'error_field' => $errMsg,
                'body_head' => mb_substr($body, 0, 500),
            ]);

            return response()->json(['answer' => 'Ich konnte dazu leider keine Antwort generieren. Bitte formulieren Sie die Frage etwas anders.']);
        }

        $raw = (string) $raw;

        // Think/Reasoning entfernen
        $stripped = preg_replace('/<think>.*?<\/think>\s*/si', '', $raw) ?? $raw;
        $stripped = preg_replace('/<think>.*$/si', '', $stripped) ?? $stripped;
        $stripped = trim($stripped);

        if ($stripped === '') {
            if (preg_match('/<\/think>\s*(.+)$/si', $raw, $m) && ! empty(trim($m[1]))) {
                $stripped = trim($m[1]);
            } else {
                $stripped = trim(str_ireplace(['<think>', '</think>'], '', $raw));
            }
        }

        if (mb_strlen($stripped) > 4000) {
            $stripped = mb_substr($stripped, 0, 4000).'…';
        }

        // ✅ Deutsch-Throughput: Wenn Antwort englisch aussieht, erzwingen wir Deutsch zuverlässig.
        if ($this->looksEnglish($stripped)) {
            $forced = $this->forceGermanOnce($hfToken, $hfModel, $systemPrompt, $question, $stripped);

            // Falls immer noch englisch -> harter Rewrite/Translate (2. Fallback)
            if ($this->looksEnglish($forced)) {
                $forced = $this->rewriteToGerman($hfToken, $hfModel, $forced, $forced);
            }

            $stripped = $forced;
        }

        return response()->json(['answer' => $stripped]);
    }

    /**
     * Stärkere English-Erkennung (deutlich robuster als nur "hello/the/fiber").
     */
    private function looksEnglish(string $answer): bool
    {
        $a = mb_strtolower(trim($answer));
        if ($a === '') {
            return false;
        }

        // Wenn deutsche Umlaute/ß vorkommen -> eher nicht EN
        if (preg_match('/[äöüß]/u', $a)) {
            return false;
        }

        // Typische englische Starts
        if (preg_match('/^(hello|hi|sure|okay|ok|here|here\'s|here is|in summary|overall|generally|you can|you should|to do this|step|first|second|third|note|please)/i', $a)) {
            return true;
        }

        // Häufige englische Funktionswörter (mind. 3 Treffer => EN)
        $hits = 0;
        foreach ([
            ' the ', ' and ', ' or ', ' not ', ' how ', ' what ', ' why ', ' when ',
            ' can ', ' should ', ' could ', ' would ', ' please ', ' there ', ' their ',
            ' fiber ', ' connection ', ' costs ', ' price ', ' in order to ', ' for example ',
        ] as $w) {
            if (str_contains(" {$a} ", $w)) {
                $hits++;
            }
        }

        return $hits >= 3;
    }

    /**
     * Einmaliger "Re-Ask" auf Deutsch.
     */
    private function forceGermanOnce(string $hfToken, string $hfModel, string $systemPrompt, string $question, string $fallback): string
    {
        try {
            $resp = Http::withToken($hfToken)
                ->acceptJson()
                ->asJson()
                ->timeout(45)
                ->post('https://router.huggingface.co/v1/chat/completions', [
                    'model' => $hfModel,
                    'stream' => false,
                    'temperature' => 0.1,
                    'max_tokens' => 260,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => 'Antworte jetzt ausschließlich auf Deutsch (kein Englisch). Frage: '.$question],
                    ],
                ]);

            if (! $resp->successful()) {
                return $fallback;
            }

            $decoded = json_decode((string) $resp->body(), true);
            $raw = data_get($decoded, 'choices.0.message.content');

            if (! is_string($raw) || trim($raw) === '') {
                return $fallback;
            }

            $raw = preg_replace('/<think>.*?<\/think>\s*/si', '', $raw) ?? $raw;
            $raw = preg_replace('/<think>.*$/si', '', $raw) ?? $raw;

            $raw = trim($raw);

            return $raw !== '' ? $raw : $fallback;
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    /**
     * Harte Rewrite/Translate-Stufe: macht aus einem Text zuverlässig Deutsch.
     * (Nur wenn wirklich nötig -> also selten.)
     */
    private function rewriteToGerman(string $hfToken, string $hfModel, string $text, string $fallback): string
    {
        try {
            $resp = Http::withToken($hfToken)
                ->acceptJson()
                ->asJson()
                ->timeout(45)
                ->post('https://router.huggingface.co/v1/chat/completions', [
                    'model' => $hfModel,
                    'stream' => false,
                    'temperature' => 0.0,
                    'max_tokens' => 260,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Du bist eine Übersetzungs-Engine. Übersetze den Text ins Deutsche. Gib NUR die Übersetzung aus, ohne Kommentar.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $text,
                        ],
                    ],
                ]);

            if (! $resp->successful()) {
                return $fallback;
            }

            $decoded = json_decode((string) $resp->body(), true);
            $raw = data_get($decoded, 'choices.0.message.content');

            if (! is_string($raw) || trim($raw) === '') {
                return $fallback;
            }

            $raw = preg_replace('/<think>.*?<\/think>\s*/si', '', $raw) ?? $raw;
            $raw = preg_replace('/<think>.*$/si', '', $raw) ?? $raw;

            $raw = trim($raw);

            return $raw !== '' ? $raw : $fallback;
        } catch (\Throwable $e) {
            return $fallback;
        }
    }
}
