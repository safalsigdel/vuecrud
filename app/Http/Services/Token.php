<?php


namespace App\Http\Services;


use App\User;

class Token
{
    public function createToken()
    {
        $getTokens = User::get(['api_token']);
        generate:
        $generateToken = str_random(20);
        foreach ($getTokens as $getToken) {
            $previousToken[] = $getToken->access_token;
        }
        if (!in_array($generateToken, $previousToken)) {
            return $generateToken;
        }else{
            goto generate;
        }
    }
}