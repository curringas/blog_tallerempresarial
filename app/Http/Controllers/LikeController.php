<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user=$request->user();
        Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $megusta= Like::where("user_id",$user->id)
                    ->where("post_id",$post->id)
                    ->get();

        // Redirigir o devolver una respuesta
        return redirect()->route('posts.show', compact('post','user','megusta'));

    }


    public function destroy(Like $like, Request $request)
    {
        //dd($like);
        $user=$request->user();
        $post=Post::find($like->post_id);
        $like->delete();
        $megusta= Like::where("user_id",$user->id)
                    ->where("post_id",$post->id)
                    ->get();
        return redirect()->route('posts.show', compact('post','user','megusta'));
    }
}
