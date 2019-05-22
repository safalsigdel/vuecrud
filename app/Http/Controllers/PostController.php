<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function home()
    {
        return view('app');
    }

    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function getSinglePost($id)
    {
        return Post::findOrFail($id);
    }

    public function updatePost(Request $request)
    {
        $posts = $request->all();
        $id = $posts['post']['id'];
        $title = $posts['post']['title'];
        $body = $posts['post']['body'];
        Post::where('id', $id)->update(['title'=>$title,'body'=>$body]);
    }

    public function deletePost($id)
    {
        Post::destroy($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where
        ('id', $id)->first();
        if(!$post){
            return response()->json(['message' => 'Resource not found'], 404);
        }else {
            $deletedPost = $post->title;
            $post->delete();
            return response()->json([ 'deletedPost' => $deletedPost],203);
        }

    }
}
