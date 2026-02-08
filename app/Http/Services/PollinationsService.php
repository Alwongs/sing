<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PollinationsService
{
    private $apiUrl;
    private $secretKey;
    
    public function __construct()
    {
        $this->apiUrl = config('pollinations.api_url');
        $this->secretKey = config('pollinations.secret_key');
    }
    
    /**
     * Генерация текста через Pollinations AI
     */
    public function generateText(string $prompt, array $options = []): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(config('pollinations.timeout'))
            ->post($this->apiUrl . '/text', [
                'prompt' => $prompt,
                'model' => $options['model'] ?? config('pollinations.default_model'),
                'max_tokens' => $options['max_tokens'] ?? 500,
                'temperature' => $options['temperature'] ?? 0.7,
            ]);
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'text' => $response->json()['choices'][0]['text'] ?? $response->json()['text'] ?? $response->body()
                ];
            }
            
            return [
                'success' => false,
                'error' => 'API request failed',
                'status' => $response->status(),
                'body' => $response->body()
            ];
            
        } catch (\Exception $e) {
            Log::error('Pollinations API error: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Альтернативный метод через GET запрос (если POST не работает)
     */
    public function generateTextGet(string $prompt, array $options = []): array
    {
        try {
            $url = $this->apiUrl . '/prompt/' . urlencode($prompt);
            $url .= '?model=' . ($options['model'] ?? config('pollinations.default_model'));
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])
            ->timeout(config('pollinations.timeout'))
            ->get($url);
            
            // Pollinations может возвращать JSON или plain text
            $contentType = $response->header('Content-Type');
            
            if (str_contains($contentType, 'application/json')) {
                $data = $response->json();
            } else {
                $data = ['text' => $response->body()];
            }
            
            return [
                'success' => true,
                'data' => $data,
                'text' => $data['text'] ?? $data['response'] ?? $response->body()
            ];
            
        } catch (\Exception $e) {
            Log::error('Pollinations GET API error: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Простой тест подключения
     */
    public function testConnection(): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])
            ->timeout(5)
            ->get($this->apiUrl . '/prompt/test');
            
            return $response->status() === 200;
            
        } catch (\Exception $e) {
            return false;
        }
    }
}