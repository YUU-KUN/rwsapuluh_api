<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

use App\Models\User;

use Auth;
use Hash;

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
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($data)) {
            return response(['message' => 'Email atau Password tidak cocok'], 401);
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

    public function forgotPassword(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $input['email'])->first();
        if (!$user) {
            return response()->json([
                'message' => "User dengan email " . $input['email'] . " tidak ditemukan"
            ], 404);
        }

        $token = $user->createToken('API Token')->accessToken;
        // $user->tokens()->where('id', $token->id)->delete();

        $reset_password_url = env('CMS_URL') . '/reset-password?t=' . $token;
        
        $data = [
            'name' => env('MAIL_FROM_NAME'),
            'body' => "Permintaan reset password telah diterima. Silahkan klik link berikut untuk mereset password anda.\n",
            'link' => $reset_password_url
        ];

       
        Mail::to($input['email'])->send(new SendEmail($data));

        return response()->json([
            'message' => 'Email permintaan reset password telah dikirim ke email anda'
        ], 200);
    }

    public function resetPassword(Request $request) {
        try {
            $input = $request->all();
            $validator = \Validator::make($input, [
                'password' => 'required|confirmed'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()
                ], 400);
            }
            
            $user = Auth::user()->update([
                'password' => Hash::make($input['password'])
            ]);
    
            Auth::user()->token()->delete();
    
            return response()->json([
                'message' => 'Password berhasil diubah. Silahkan login kembali.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
