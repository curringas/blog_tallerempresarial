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

    public function edit($id=null)
    {
        //dd($id);
        if($id!=null){
            $post=Post::find($id);
            $title = 'Editar Post';
            $subtitle = 'Aqui puedes modificar este artículo';
            $route = "posts.update";
        }else{
            $post = null;
            $title = 'Crear Post';
            $subtitle = 'Aqui puedes crear un nuevo artículo';
            $route = 'posts.save';
        }
        return view('posts.edit',compact('post','title','subtitle','route'));
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

    public function update(Request $request)
    {
        $post=Post::find($request->id);
        if (!$request->id) {
            return redirect()->route('dashboard');
        }else{
            //$post = new Post();
            //$post->where('id',$request->id)->get();
            //dd($request->id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->category = $request->category;
            $post->update();
            return redirect()->route('posts.view',['post'=>$request->id]);
        }
    }
}