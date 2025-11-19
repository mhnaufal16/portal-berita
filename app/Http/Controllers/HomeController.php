<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
                    ->where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->take(6)
                    ->get();

        return view('home', compact('posts'));
    }
}