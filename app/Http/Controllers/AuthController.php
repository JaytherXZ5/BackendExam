<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required', // This will accept either username or email
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        $credentials = [
            filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->login,
            'password' => $request->password,
        ];

        $remember = $request->remember ?? false;

        if (Auth::attempt($credentials, $remember)) {
            $user = $request->user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json(['message' => 'Invalid login credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
