<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function Login(Request $request) {
        $inputs= ['email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($inputs)) {
            $user = User::where('email', $inputs['email'])->first();

            $token = Str::random(60);

            $user->api_token = $token;
            $user->save();
            return $user;
            
        } else {
            return null;
        }
        //return $user;
}

    public function updateToken(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => $token,
        ])->save();

        return ['token' => $token];
    }
    
}
