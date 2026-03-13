<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseApiController;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiBaseApiController
{
    public function login(LoginRequest $request)
    {
        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', [], 401);
        }

        // Get authenticated user
        $user = User::select('id', 'name', 'type', 'status')->where('email', $request->email)->first();

        // Create token
        $token = $user->createToken('api-token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $this->success($data, 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success('Logged out successfully');
    }
}
