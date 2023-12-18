<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /* function to login user */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user->is_active==false){
            return error(401,__('string.UserInactive'));
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            $data['token'] = $user->createToken("API TOKEN")->plainTextToken;
            return success(200, __('string.LoginSuccess'), $data);
        }

        return error(403, __('string.InvalidCredentials'));
    }

    /* function to logout user */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return success(200, __('string.LogoutSuccess'));
    }
}
