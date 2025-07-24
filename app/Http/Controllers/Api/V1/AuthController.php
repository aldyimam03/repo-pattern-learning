<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Mail\VerifyUserMail;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication endpoints"
 * )
 */
class AuthController
{
    public function __construct(protected AuthService $authService) {}

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="User registration",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="Anomali 2"),
     *             @OA\Property(property="email", type="string", format="email", example="anomali2@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully. Check your inbox to verify email"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to register"
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->register($request);

            return response()->json([
                'message' => 'User registered successfully. Check your inbox to verify email',
                'data' => $user,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to register',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="anomali2@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="user", type="object"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Failed to login"
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {
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

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout user",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logged out successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to logout"
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        try {

            return $this->authService->logout($request);

            //MANUAL TOKEN
            // $user = $request->attributes->get('auth_user'); 
            // $user->api_token = null;
            // $user->save();
            //return response()->json(['message' => 'Logged out successfully']);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to logout',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
