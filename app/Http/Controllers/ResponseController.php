<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $result,
        ];


        return response()->json($response, $code);
    }

    public static function sendError($error, $errorMessages = "", $code = 404)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $error,
            'data' => $errorMessages,
        ];

        return response()->json($response, $code);
    }
}
