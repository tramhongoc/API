<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $response = [
            "code" => 200,
            "status" => 1,
            "data" => [],
            "message" => 'Login success'
        ];

        $credentials = [
            'email' => $request->header("email"),
            'password' => $request->header("password")
        ];
        $user = User::findOrFail($request->header("email"));
        if ($user) {
            $response["data"] = [
                "user_id" => $user->id,
                "access_token" => $user->remember_token
            ];
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json($response);
        }
    }
}
