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
        $hfModel = config('services.huggingface.model');

        // Prüfe, ob Modellname gesetzt ist
        if (!$hfModel) {
            return response()->json([
                'error' => 'Huggingface Modellname fehlt!',
            ], 500);
        }

        $response = Http::withToken($hfToken)
            ->timeout(30)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post("https://api-inference.huggingface.co/models/{$hfModel}", [
                'inputs' => $validated['question'],
            ]);

        if (!$response->successful()) {
            Log::error('HF API Fehler', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return response()->json([
                'error'   => 'HF API returned error',
                'details' => $response->body(),
            ], 500);
        }

        $result = $response->json();

        // Passe das Parsing an verschiedene Modellantworten an
        $answer = data_get($result, '0.generated_text') ??
                  data_get($result, 'generated_text') ??
                  json_encode($result);

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
