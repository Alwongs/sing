<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PollinationsController extends Controller
{
    public function index()
    {
        return view('admin.pollinations.index');
    }

    public function handleText(Request $request)
    {
        try {
            $userText = $request->input('text');
            
            if (empty($userText)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Текст не может быть пустым'
                ], 400);
            }

            $pollinationsResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('POLLINATIONS_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://gen.pollinations.ai/v1/chat/completions', [
                'model' => 'openai-fast',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $userText
                    ]
                ]
            ]);

            if ($pollinationsResponse->successful()) {
                $responseData = $pollinationsResponse->json();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Успешно получен ответ от Pollinations AI',
                    'original_text' => $userText,
                    'pollinations_response' => $responseData,
                    'ai_message' => $responseData['choices'][0]['message']['content'] ?? 'Ответ не содержит текста'
                ]);
            } else {
                Log::error('Pollinations API Error', [
                    'status' => $pollinationsResponse->status(),
                    'response' => $pollinationsResponse->body()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка при обращении к Pollinations AI',
                    'error_code' => $pollinationsResponse->status(),
                    'error_details' => $pollinationsResponse->body()
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Pollinations Integration Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Внутренняя ошибка сервера',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getModels(Request $request)
    {

    }
}
