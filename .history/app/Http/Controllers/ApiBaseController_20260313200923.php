<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ApiBaseApiController extends Controller
{
    protected function success($message = 'Success', $data = [], $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message = 'Something went wrong', $errors = [], $code = 400,)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
