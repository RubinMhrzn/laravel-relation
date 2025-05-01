<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    // register
    // login
    // change password
    // forgot password

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // $user->tokens()->delete();

            // Generate a new token
            $tokenData = $user->createToken('token');

            $payload['token']      = $tokenData->accessToken;
            $payload['expires_in'] = $tokenData->token->expires_at->toDateTimeString();
            $payload['auth']       = new AuthUserResource($user);

            return response()->json([
                'message' => 'login sucess',
                'data' => $payload
            ]);
        }
    }

    public function getUser()
    {
        return Auth::user();
    }
}
