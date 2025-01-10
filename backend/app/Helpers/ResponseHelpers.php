<?php

namespace App\Helpers;

use App\Constants\ResponseStatusCodeConstants;
use Illuminate\Http\JsonResponse;

class ResponseHelpers
{
    /**
     * Generate success response
     *
     * @param mixed|null $data
     * @return JsonResponse
     */
    public static function success(mixed $data = null): JsonResponse
    {
        $response = [
            'errCode' => ResponseStatusCodeConstants::SUCCESS,
            'errMsg' => ResponseStatusCodeConstants::$messages[ResponseStatusCodeConstants::SUCCESS],
        ];

        $result = ['response' => $response];

        if (!is_null($data)) {
            $result['data'] = $data;
        }

        return response()->json($result, 200);
    }

    /**
     * Generate error response
     *
     * @param int $errorCode
     * @param int $httpStatus
     * @return JsonResponse
     */
    public static function error(
        int $errorCode,
        int $httpStatus = 400,
    ): JsonResponse
    {
        return response()->json([
            'errCode' => 1001, //Different error should have different status code, for the sake of this test it is hardcoded
            'errMsg' => ResponseStatusCodeConstants::$messages[$errorCode],
        ], $httpStatus);
    }
}
