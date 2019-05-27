<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;


class SearchController extends Controller
{
    public function index(Request $request,$name)
    {
        $value = $request->q;
        if ($name == 'user') {
            $user = User::where('first_name', 'like', '%' . $value . '%')
                ->orWhere('last_name','like','%'.$value.'%')
                ->orWhere('email', 'like', '%' . $value . '%')
                ->orWhere('profession', 'like', '%' . $value . '%')
                ->orWhere('phone', 'like', '%' . $value . '%')
                ->get();
            return response()->json($user);

        }
        if ($name == 'post') {
            $post = Post::where('title', 'like', '%' . $value . '%')
                ->orWhere('body','like','%'.$value.'%')
                ->get();
            return response()->json($post);
        }

    }
}
