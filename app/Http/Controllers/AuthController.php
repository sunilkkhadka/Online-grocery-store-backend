<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request){
        try{
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    'message' => "successfully logged in",
                    'token' => $token,
                    'userData' => $user,
                ],200);
            }

        }
        catch(Exception $e){
            return response([
                'message' => $e,
            ], 400);
        }

        return response([
            'message' => 'invalide email or password'
        ]);
    }

    public function Register(RegisterRequest $request){
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $token = $user->createToken('app')->accessToken;

            return response([
                'message' => "Registered successfully",
                'token' => $token,
                'userData' => $user,
            ],200);

        }
        catch(Exception $e){
            return response([
                'message' => $e,
            ], 400);
        }
    }

    public function logout(){
        Auth::logout();
    }
}
