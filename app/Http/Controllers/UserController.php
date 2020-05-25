<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = [
        'email' => $request->header('email'),
        'password' => $request->header('password')
        ];
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
//        if ($request->remember_me)
//            $token->expires_at = Carbon::now()->addWeeks(1);
//        $token->save();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'data' => [
                'user-id' => $user->id,
                'access_token' => $tokenResult->accessToken,
            ],
            'message' => 'Login success'
        ]);
    }

    /*
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'code' => 200,
            'status' => 1,
            'data'=> '',
            'message' => 'Logout success'
        ]);
    }
    /*
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function profile(Request $request){
        return response()->json([
            'code' => 200,
            'status' => 1,
            'data' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'birthday' => $request->user()->birthday,
            ],
            'message' => ''
        ]);
    }
}

