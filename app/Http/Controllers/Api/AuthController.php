<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($credentials->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => trans('The provided credentials do not match our records.'),
            ]);
        }
 
        if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password])) {

            $user = User::where("email", strtolower($request->email))->first();
            
            $public_token = Str::random(18);
            $secret_token = Str::random(128);
            UserToken::create([
                'secret_token' => Hash::make($secret_token),
                'user_id' => $user->id,
                'public_token' => $public_token,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => trans('You have been successfully authenticated'),
                'public_token' => $public_token,
                'secret_token' => $secret_token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('The provided credentials do not match our records.'),
        ]);
    }

    public function register()
    {

    }
}
