<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // register user
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25', 'min:3'],
            'nickname' => ['required', 'string', 'min:3', 'max:25', 'unique:users,nickname'],
            'password' => ['required', Password::min(8)->letters()->symbols()->numbers()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'user created successfully',
        ], 201);
    }
}
