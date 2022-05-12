<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'status' => $code,
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
            'error' => $error,
            'errorMessages' => $errorMessages,
        ];

        return response()->json($response, $code);
    }
}
