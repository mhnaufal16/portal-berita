<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::with('category')
                    ->where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}