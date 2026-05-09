<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";

    public function __construct()
    {
        $this->apiKey = env("GEMINI_API_KEY");
    }

    public function chat($messages)
    {
        $contents = collect($messages)->map(function ($msg) {
            return [
                "role" => $msg['role'],
                "parts" => [["text" => $msg['content']]]
            ];
        })->toArray();

        try {
            $response = Http::withHeaders([
                "Content-Type" => "application/json",
            ])
                ->timeout(30)              // maksimal tunggu 30 detik
                ->retry(3, 2000, function ($exception, $request) {
                    // retry hanya kalau timeout atau server error (status 5xx)
                    return $exception instanceof \Illuminate\Http\Client\RequestException
                        || ($request && $request->serverError());
                })
                ->post($this->baseUrl . "?key=" . $this->apiKey, [
                    "contents" => $contents
                ]);

            if ($response->successful()) {
                return $response->json("candidates.0.content.parts.0.text");
            }

            return "Balabot tidak dapat merespons saat ini. [Error: " . $response->status() . "]";
        } catch (\Exception $e) {
            return "Balabot error: " . $e->getMessage();
        }
    }
}
