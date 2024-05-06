<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:100|string',
            'last_name' => 'required|min:3|max:100|string',
            'email' => 'required|email|max:100|string',
            'password' => 'required|min:6|string',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'USER'
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'status' => 200
        ], 200);
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully',
                'status' => 200,
                'role' => $user->role,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
                'status' => 401
            ], 401);
        }
    }
}
