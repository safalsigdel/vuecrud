<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\RegisterRequest;
use App\Http\Services\Token;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    public $tokenService;

    public function __construct(Token $tokenService)
    {

        $this->tokenService = $tokenService;
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        if ($user) {
            $token = $this->tokenService->createToken();
            $user->api_token = $token;
            $user->save();
        }
    }
    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email, 'password' => $request->password])->first();
        if ($user) {
            return response()->json($user);
        }else{
            return response()->json(['false'],401);
        }
    }
}
