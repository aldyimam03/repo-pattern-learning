<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\VerifyUserMail;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService

{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            // Kirim email verifikasi setelah user berhasil dibuat
            Mail::to($user->email)->send(new VerifyUserMail($user));
        }

        return $user;
    }

    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $credentials = $request->only('email', 'password');

        //if auth failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        //if auth success
        return [
            'success' => true,
            'user'    => auth()->guard('api')->user(),
            'token'   => $token
        ];

        // MANUAL TOKEN
        // $token = Str::random(60);
        // $user->api_token = $token;
        // $user->save();

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(Request $request)
    {
        // MANUAL TOKEN
        // $token = $request->bearerToken();
        // $user = User::where('api_token', $token)->first();
        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     throw new \Exception('Invalid credentials');
        // }
        // $user->api_token = null;
        // $user->save();

        //remove token

        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            return response()->json([
                'message' => 'Logout Successfully',
            ]);
        }
    }
}
