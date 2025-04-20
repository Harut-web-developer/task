<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function publish(Request $request){
        $request->validate([
            'website_id' => 'required | exists:websites,id',
            'title' => 'required | string | max:255',
            'description' => 'required | string',
        ]);
        $post = Post::create([
            'website_id' => $request->website_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return response()->json([
            'message' => 'Post created!',
            'data' => $post
            ], 201);
    }
}
