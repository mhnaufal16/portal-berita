<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->is_published = $request->has('is_published');
        $post->published_at = $request->has('is_published') ? now() : null;
        $post->user_id = auth()->id();

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil dibuat!');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->is_published = $request->has('is_published');
        
        if ($request->has('is_published') && !$post->published_at) {
            $post->published_at = $request->published_at ?: now();
        }

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // Quick Actions
    public function quickPublish(Post $post)
    {
        $post->update([
            'is_published' => true,
            'published_at' => now()
        ]);

        return back()->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function quickUnpublish(Post $post)
    {
        $post->update([
            'is_published' => false
        ]);

        return back()->with('success', 'Berita berhasil di-unpublish!');
    }
}