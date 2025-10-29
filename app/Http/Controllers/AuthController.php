<?php

namespace App\Http\Controllers;

use App\Models\RefreshToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

        //check user ip
            $c_i = User::where('user_ip', $request->ip())->get();

        if($c_i)
            return response()->json([
                'error' => 'with your ip user exist',
            ], 409);

        $user = User::create([
            'user_ip' => $request->ip(),
            'name' => $request->name,
            'nickname' => $request->nickname,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'user created successfully',
        ], 201);
    }

    //login user -> send token auth
    public function login(Request $request)
    {
        $request->validate([
            'nickname' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $ch_user = $request->only('nickname', 'password');

        //login user
            if(!auth()->attempt($ch_user)) {
                return response()->json([
                    'error' => 'Invalid credentials.',
                ], 401);
            }

            $user = Auth::user();

            //check user token
                if($user->token)
                    $user->token->delete();

        // create token and send;
            $token = Str::random(70);

            RefreshToken::create([
                'token' => Hash::make($token),
                'user_id' => $user->user_id,
            ]);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }
}
