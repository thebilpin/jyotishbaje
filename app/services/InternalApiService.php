<?php

namespace App\Services;

use App\Http\Controllers\API\User\ChatRequestController;
use App\Http\Controllers\API\User\CallRequestController;
use Illuminate\Http\Request;

class InternalApiService
{
    /**
     * Get user intake form without HTTP call
     */
    public static function getUserIntakeForm($token = null, $userId = null)
    {
        try {
            $controller = new ChatRequestController();
            $request = new Request([
                'token' => $token,
                'userId' => $userId
            ]);
            
            $response = $controller->getUserIntakForm($request);
            return $response->getData(true);
        } catch (\Exception $e) {
            return [
                'message' => 'Failed to get intake form',
                'status' => 500,
                'recordList' => [],
                'default_time' => 5
            ];
        }
    }

    /**
     * Get chat requests without HTTP call
     */
    public static function getChatRequests($astrologerId, $token = null)
    {
        try {
            $controller = new ChatRequestController();
            $request = new Request([
                'astrologerId' => $astrologerId,
                'token' => $token
            ]);
            
            $response = $controller->getChatRequest($request);
            return $response->getData(true);
        } catch (\Exception $e) {
            return [
                'message' => 'Failed to get chat requests',
                'status' => 500,
                'recordList' => []
            ];
        }
    }

    /**
     * Get call requests without HTTP call
     */
    public static function getCallRequests($astrologerId, $token = null)
    {
        try {
            $controller = new CallRequestController();
            $request = new Request([
                'astrologerId' => $astrologerId,
                'token' => $token
            ]);
            
            $response = $controller->getCallRequest($request);
            return $response->getData(true);
        } catch (\Exception $e) {
            return [
                'message' => 'Failed to get call requests',
                'status' => 500,
                'recordList' => []
            ];
        }
    }

    /**
     * Make safe HTTP calls with fallback
     */
    public static function safeHttpCall($url, $data = [], $timeout = 5)
    {
        try {
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->timeout($timeout)
                ->post($url, $data);
                
            if ($response->successful()) {
                return $response->json();
            }
            
            return null;
        } catch (\Exception $e) {
            \Log::warning("HTTP call failed: " . $e->getMessage());
            return null;
        }
    }
}