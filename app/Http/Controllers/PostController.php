<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //**********************************************************
    //  *** CRUD ****
    //********************************************************** 
    public function index(Request $request)
    {
        //
        if ($request->category_id){
            $posts=Post::where('category_id',$request->category_id)->orderBy('created_at', 'desc')->paginate(3);
        }else{
            $posts=Post::orderBy('created_at', 'desc')->paginate(3);
        }
        $user = $request->user();
        $subtitle ="Todos los artículos";
        $liked = false;
        $categories = Category::orderBy("name")->get();
        $category_id = $request->category_id;
        return view('posts.index', compact('posts','user','subtitle','liked','categories','category_id'));
    }

    public function liked(Request $request)
    {
        $user = $request->user();
        $posts = Post::
            join('likes', 'likes.post_id', '=', 'posts.id')
                ->where('likes.user_id', '=', $user->id)
                ->orderBy('posts.created_at', 'desc')->paginate(3);

        //$posts=Post::orderBy('created_at', 'desc')->paginate(3);
        $subtitle ="Mis artículos favoritos";
        $liked = true;
        return view('posts.index', compact('posts','user','subtitle','liked'));
    }

    public function show(Post $post, Request $request)
    {   
        if($post){
            //$post=Post::find($id);
            $user = $request->user();
            $megusta= Like::where("user_id",$user->id)
                        ->where("post_id",$post->id)
                        ->get();
            return view('posts.show',compact('post','user','megusta'));
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
        $categories = Category::orderBy("name")->get();
        return view('posts.edit',compact('id','post','title','subtitle','route','categories'));
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
        $categories = Category::orderBy("name")->get();
        return view('posts.edit',compact('post','title','subtitle','route','categories'));
    }

    public function store(Request $request)
    {
        $user=$request->user();
        //dd($user->profile);
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        // Validación para la actualización
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => ['required','string','max:255',
                        'unique:categories,slug',  // Valida que el slug sea único en la tabla "categories"
                        'regex:/^[a-z0-9-]+$/',  // Valida que el slug solo tenga minúsculas, números y guiones
                        ],
            'category_id' => 'required|exists:categories,id',  // Valida que la categoría exista en la tabla "categories"
            'content' => 'required|string',  // Validación para la descripción (opcional)
        ]);

        Post::create($validatedData);
        /*$post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->published_at = now();
        $post->save();*/
        return redirect()->route('dashboard')->with('success', 'Nuevo artículo creado con éxito!');;
    }

    public function update(Request $request, Post $post)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //dd($request);
        // Validación para la actualización
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => ['required','string','max:255',
                        'unique:categories,slug,'. $post->id,  // Valida que el slug sea único en la tabla "categories"
                        'regex:/^[a-z0-9-]+$/',  // Valida que el slug solo tenga minúsculas, números y guiones
                        ],
            'category_id' => 'required|exists:categories,id',  // Valida que la categoría exista en la tabla "categories"
            'content' => 'required|string',  // Validación para la descripción (opcional)
        ]);

        //$post=Post::find($id);
        if (!$post) {
            return redirect()->route('dashboard');
        }else{
            $post->update($validatedData);
            //$post->title = $request->title;
            //$post->slug = $request->slug;
            //$post->content = $request->content;
            //$post->category_id = $request->category_id;
            //$post->update();
            return redirect()->route('posts.show',$post)->with('success', 'Artículo modificado con éxito!');
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