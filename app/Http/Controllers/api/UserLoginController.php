<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email, 'password' => $request->password])->first();
        if ($user) {
            return response()->json($user);
        }else{
            return response()->json('false');
        }
    }
}
