<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts=Post::orderBy('created_at', 'desc')->get();
        $user = $request->user();
        return view('posts.index', compact('posts','user'));
    }

    public function show($post, Request $request)
    {
        if($post){
            $post=Post::find($post);
            $user = $request->user();
            return view('posts.show',compact('post','user'));
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function edit($post=null)
    {
        if($post){
            $post=Post::find($post);
        }
        return view('posts.edit',compact('post'));
    }

    public function save(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->published_at = now();
        $post->save();
        return redirect()->route('dashboard');
    }
}