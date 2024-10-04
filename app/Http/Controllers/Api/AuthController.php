<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
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

        if ($credentials->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => trans('The provided credentials do not match our records.'),
            ]);
        }

        if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password])) {

            $user = User::where("email", strtolower($request->email))->first();

            return response()->json([
                'status' => 'success',
                'message' => trans('You have been successfully authenticated'),
                'token' => $user->token ? $user->token->token : UserToken::updateOrCreate(['user_id' => $user->id, 'token' => fake()->uuid()])->token
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('The provided credentials do not match our records.'),
        ]);
    }

    public function rotateKey(Request $request)
    {
        if (Auth::check()) {
            auth()->user()->token->token = fake()->uuid();
            auth()->user()->token->save();

            return response()->json([
                'status' => 'success',
                'message' => trans('You have been successfully authenticated'),
                'token' => auth()->user()->token->token
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => trans('The provided credentials do not match our records.'),
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:36'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => '',
                'status' => 'error',
                'data' => $validator->messages()->get('*'),
                'type' => 'validation'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->roles()->sync([Role::where('name', 'author')->pluck('id')->first()]);

        $token = UserToken::create([
            'token' => fake()->uuid(),
            'user_id' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => trans('You have been successfully registered'),
            'token' => $token->token
        ]);
    }
}
