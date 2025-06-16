<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController
{
    public function __construct(protected AuthService $authService) {}

    public function register(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = $this->authService->register($request);
            return response()->json([
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to register',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = $this->authService->login($request);

            return response()->json([
                'message' => 'Login successful',
                'user' => $user['user'],
                'token' => $user['token'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to login',
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->attributes->get('auth_user'); 

            $user->api_token = null;
            $user->save();

            return response()->json(['message' => 'Logged out successfully']);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to logout',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
