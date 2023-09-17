<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utils\ResponseBuilder;

class AuthController extends Controller
{
    public function loginAccount(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request['remember'])) {
           
            return Auth::check();

            // if(Auth::check())
            //     return ResponseBuilder::response(http_response_code(),"Login Success!");
            // else
            //     return ResponseBuilder::response(http_response_code(500),"Login Error!");
        }
        // else
        //     return ResponseBuilder::response(401,"Login Failed!");
    }

    public function logoutAccount()
    {
        Auth::logout();
    }
}
