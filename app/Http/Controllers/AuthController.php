<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|min:6'

            ]
        );

        if (!Auth::attempt($request->only(['email', 'password'])) && Hash::check($request->password, User::where('email', $request->email)->pluck('password'))) {
            abort(401, 'Credientials do not match');
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken($user->name)->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response([
                'message' => 'You Have logged out'
            ]);
        };
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6|max:255|string',
            'email' => 'required|unique:users|min:6|max:255|string|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]
        );
        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
