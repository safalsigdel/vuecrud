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
        $post= Post::findOrFail($id);
        if ($post) {
            return response()->json($post);
        }else{
            return response()->json(['message' => 'Requested resource not found']);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        if ($post) {
            return response()->json($post);
        }else{
            return response()->json(['message' => "Couldn't create post"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json(Post::find($id));
        }else{
            return response()->json(['message' => "Post not found "]);
        }
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
        $posts = $request->all();
        $title = $posts['post']['title'];
        $body = $posts['post']['body'];
        $post = Post::where('id', $id)->update(['title'=>$title,'body'=>$body]);
        if ($post) {
            return response()->json($request->all());

        }else{
            return response()->json(['message' => "Post couldn't updated"]);
        }
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
            return response()->json(['message'=>'Post deleted','name'=>$deletedPost],203);
        }

    }
}
