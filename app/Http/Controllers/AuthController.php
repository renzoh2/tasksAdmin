<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utils\ResponseBuilder;

class AuthController extends Controller
{
    public function loginAccount(Request $request)
    {
        $rules  = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            
            'email:required' => 'Email Address is Required',
            'email' => 'Please enter correct Email Address',
            'password:required' => 'Password is Required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return ResponseBuilder::response(http_response_code(), "Fail","Login Error!", $validator->getMessageBag()->first());
        }


        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request['remember'])) {
           
            $user = Auth::user();
            
            /** @var \App\Models\User|null $user */
            $data["token"] = $user->createToken('adminTaskToken')->plainTextToken; 
            $data['name'] =  $user->name;

            if(Auth::check())
                return ResponseBuilder::response(http_response_code(),"Success","Login Success!", "Login Credentials Authenticated", $data);
            else
                return ResponseBuilder::response(http_response_code(), "Fail","Login Error!","Login Credentials Failed to Authenticate");
        }
        else
            return ResponseBuilder::response(http_response_code(), "Fail","Login Failed!", "Wrong Login Credentials");
    }

    public function logoutAccount()
    {
        $user = Auth::user();

        /** @var \App\Models\User|null $user */
        $user->tokens()->delete();
        return Auth::logout();
    }
}
