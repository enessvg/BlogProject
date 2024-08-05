<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponserTrait
{
    protected function successResponse($data, string $message, int $httpResponseCode = 200): JsonResponse {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);
    }

     protected function errorResponse(string $message, int $httpResponseCode = 404): JsonResponse {
         return response()->json([
             'status' => false,
             'message'    => $message ?? null,
         ], $httpResponseCode);
     }
}
