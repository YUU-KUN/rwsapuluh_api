<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        // \Validator::make($input, [
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed'
        // ])->validate();

        $input['password'] = Hash::make($request->password);

        $user = User::create($input);

        $token = $user->createToken('API Token')->accessToken;

        return response()->json(
            [ 
                'user' => $user, 
                'token' => $token
            ]
        );
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->json(
            [
                'success' => true,
                'message' => 'Success login',
                'data' => [
                    'user' => auth()->user(), 
                    'token' => $token,
                ]
            ]
        );

    }

}
