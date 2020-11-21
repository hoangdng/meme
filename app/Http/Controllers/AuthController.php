<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class AuthController extends Controller
{
    //allow users to log in by username or email 
    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            $token = JWTAuth::attempt(['email' => $username, 'password' => $password]);
        } else {
            //they sent their username instead
            $token = JWTAuth::attempt(['username' => $username, 'password' => $password]);
        }

        //wrong credentials
        if (!$token) {
            return response()->json(['error' => 'Unauthorized User'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        if ($token) {
            //disable jwt token when user log out
            JWTAuth::setToken($token)->invalidate();
        }
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

}
