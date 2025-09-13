<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookService
{
    protected $token;
    protected $pageId;
    protected $apiVersion;

    public function __construct()
    {
        $this->token = config('facebook.access_token');
        $this->pageId = config('facebook.page_id');
        $this->apiVersion = config('facebook.api_version');
    }

    public function postToPage(string $message): array
    {
        try {
            $response = Http::post(
                "https://graph.facebook.com/{$this->apiVersion}/{$this->pageId}/feed",
                [
                    'message' => $message,
                    'access_token' => $this->token
                ]
            );

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'message' => 'Publicación creada exitosamente'
                ];
            }

            $error = $response->json();
            Log::error('Facebook API Error', $error);
            
            return [
                'success' => false,
                'error' => $error['error']['message'] ?? 'Error desconocido',
                'code' => $error['error']['code'] ?? 500
            ];

        } catch (\Exception $e) {
            Log::error('Facebook Service Exception', [
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function getPageInfo(): array
    {
        try {
            $response = Http::get(
                "https://graph.facebook.com/{$this->apiVersion}/{$this->pageId}",
                [
                    'fields' => 'id,name,link',
                    'access_token' => $this->token
                ]
            );

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Facebook Service Exception', [
                'error' => $e->getMessage()
            ]);
            return ['error' => $e->getMessage()];
        }
    }
    // En tu FacebookService.php
public function getPageAccessToken($pageId)
{
    try {
        $response = Http::get(
            "https://graph.facebook.com/v18.0/{$pageId}",
            [
                'fields' => 'access_token',
                'access_token' => $this->token
            ]
        );

        return $response->json()['access_token'] ?? null;
        
    } catch (\Exception $e) {
        Log::error('Error getting page token', ['error' => $e->getMessage()]);
        return null;
    }
}
}