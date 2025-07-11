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
        'question' => 'required|string',
    ]);

    $hfToken = config('services.huggingface.token');
    $hfModel = config('services.huggingface.model', 'HuggingFaceTB/SmolLM3-3B');

    $response = Http::withToken($hfToken)
        ->timeout(60)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
        ->post('https://router.huggingface.co/hf-inference/models/HuggingFaceTB/SmolLM3-3B/v1/chat/completions', [
            'model' => $hfModel,
            'stream' => false,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $validated['question'],
                ],
            ],
        ]);

    if (!$response->successful()) {
        \Log::error('HF Chat API Fehler', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);
        return response()->json([
            'error'   => 'HF Chat API returned error',
            'details' => $response->body(),
        ], 500);
    }

    $result = $response->json();
    $rawAnswer = data_get($result, 'choices.0.message.content') ?? json_encode($result);

    // Filter: Alles ab erstem "**" (für Markdown-Antwort) oder ab "Glasfaser" oder deutschem Satz
    if (preg_match('/(\*\*Glasfaser.+)$/s', $rawAnswer, $match)) {
        $answer = $match[1];
        } else if (preg_match('/(Glasfaser.+)$/s', $rawAnswer, $match)) {
            $answer = $match[1];
        } else if (preg_match('/([A-ZÄÖÜ][^.!?\n]+[.!?\n].*)/s', $rawAnswer, $match)) {
            // Fallback: erster deutscher Satz (grob)
            $answer = $match[1];
        } else {
            // Falls alles fehlschlägt: komplette Antwort als Fallback
            $answer = $rawAnswer;
        }

    return response()->json(['answer' => $answer]);
    }


//     public function answer(Request $request)
//     {
//     \Log::info('AI Payload: '.$request->getContent());
//         $request->validate([
//         'question' => 'required|string',
//     ]);

//     $apiKey = config('services.openai.key'); // oder env('OPENAI_API_KEY')

//     $openAiResponse = Http::withToken($apiKey)
//         ->post('https://api.openai.com/v1/chat/completions', [
//             'model'    => 'gpt-4o-mini',
//             'messages' => [
//                 [
//                     'role'    => 'system',
//                     'content' => 'Du bist ein hilfreicher Ratgeber-Bot für Glasfaser-Themen.'
//                 ],
//                 [
//                     'role'    => 'user',
//                     'content' => $request->input('question'),
//                 ],
//             ],
//             'temperature' => 0.7,
//         ]);

//     if ($openAiResponse->failed()) {
//         \Log::error('OpenAI-API Fehler:', $openAiResponse->json());
//         return response()->json([
//             'error' => 'Fehler beim AI-Service',
//         ], 500);
//     }

//     $answer = $openAiResponse['choices'][0]['message']['content'] ?? null;

//     return response()->json([
//         'answer' => $answer,
//     ]);
// }
}
