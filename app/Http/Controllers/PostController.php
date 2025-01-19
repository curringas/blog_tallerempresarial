<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //**********************************************************
    //  *** CRUD ****
    //********************************************************** 
    public function index(Request $request)
    {
        $posts=Post::orderBy('created_at', 'desc')->paginate(3);
        $user = $request->user();
        return view('posts.index', compact('posts','user'));
    }

    public function show(Post $post, Request $request)
    {   
        if($post){
            //$post=Post::find($id);
            $user = $request->user();
            return view('posts.show',compact('post','user'));
        }else{
            return redirect()->route('dashboard');
        }
        return $post;
    }

    public function create(Request $request)
    {
        $user=$request->user();
        //dd($user->profile);
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //Definimos las variables para mandar al formulario de editar que seral el mismo que crear
        $id=null;
        $post = null;
        $title = 'Crear Post';
        $subtitle = 'Aqui puedes crear un nuevo artículo';
        $route = 'posts.store';
        return view('posts.edit',compact('id','post','title','subtitle','route'));
    }

    public function edit(Post $post, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //Definimos las variables para mandar al formulario de editar que seral el mismo que crear
        //$post=Post::find($id);
        $title = 'Editar Post';
        $subtitle = 'Aqui puedes modificar este artículo';
        $route = "posts.update";
        return view('posts.edit',compact('post','title','subtitle','route'));
    }

    public function store(Request $request)
    {
        $user=$request->user();
        //dd($user->profile);
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->published_at = now();
        $post->save();
        return redirect()->route('dashboard');
    }

    public function update(Request $request, Post $post)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //$post=Post::find($id);
        if (!$post) {
            return redirect()->route('dashboard');
        }else{
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->content = $request->content;
            $post->category = $request->category;
            $post->update();
            return redirect()->route('posts.show',$post);
        }
    }

    public function destroy(Post $post, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //$post=Post::find($id);
        $post->delete();
        return redirect()->route('dashboard');
    }
}