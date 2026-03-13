<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiBaseApiController extends Controller
{
    protected function success($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message = 'Something went wrong', $code = 400, $errors = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
