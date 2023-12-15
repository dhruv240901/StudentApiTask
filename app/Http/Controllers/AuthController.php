<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Response;

    /* function to login user */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = User::where('email', $request->email)->first();
            $data['token'] = $user->createToken("API TOKEN")->plainTextToken;
            return $this->success(200, 'User Logged In Successfully', $data);
        }

        return $this->error(401, 'Invalid Credentials');
    }

    /* function to logout user */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success(200, 'User Logged Out Successfully');
    }
}
