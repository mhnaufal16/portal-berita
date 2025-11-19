<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // TAMBAHKAN INI
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Post::with(['category', 'user'])->latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all()); // Uncomment untuk debug

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        try {
            // Tentukan status publish
            $isPublished = false;
            $publishedAt = null;

            // Cek dari action button
            if ($request->action === 'publish') {
                $isPublished = true;
                $publishedAt = now();
            }

            // Cek dari checkbox (sebagai fallback)
            if ($request->boolean('is_published')) {
                $isPublished = true;
                $publishedAt = now();
            }

            // Buat post dengan category_id dari form
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'excerpt' => Str::limit(strip_tags($request->content), 150),
                'is_published' => $isPublished,
                'published_at' => $publishedAt,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id, // AMBIL DARI FORM
            ]);

            return redirect()->route('admin.pages.index')
                ->with('success', 'Halaman berhasil dibuat!');

        } catch (\Exception $e) {
            logger()->error('Error creating page: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Post $post)
    {
        return view('admin.pages.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        
        // Ubah parameter dan variable menjadi $page untuk konsistensi
        return view('admin.pages.edit', [
            'page' => $post, // Ubah $post menjadi $page
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'content' => 'required',
        ]);

        try {
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->content = $request->content;
            
            // Handle publish status dari checkbox
            $post->is_published = $request->boolean('is_published');
            
            if ($request->boolean('is_published') && !$post->published_at) {
                $post->published_at = now();
            } elseif (!$request->boolean('is_published')) {
                $post->published_at = null;
            }

            // Update excerpt jika content berubah
            $post->excerpt = Str::limit(strip_tags($request->content), 150);

            $post->save();

            return redirect()->route('admin.pages.index')
                ->with('success', 'Halaman berhasil diperbarui!');

        } catch (\Exception $e) {
            logger()->error('Error updating page: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
{
    try {
        \Log::info('=== DELETE PROCESS STARTED ===');
        
        // Cari post by ID
        $post = Post::findOrFail($id);
        \Log::info('Found post: ID=' . $post->id . ', Title=' . $post->title);
        
        // Delete featured image jika ada
        if ($post->featured_image) {
            \Log::info('Deleting featured image: ' . $post->featured_image);
            if (Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
                \Log::info('Featured image deleted successfully');
            } else {
                \Log::warning('Featured image file not found: ' . $post->featured_image);
            }
        }
        
        // Delete post dari database
        \Log::info('Deleting post from database...');
        $post->delete();
        \Log::info('Post deleted from database successfully');
        
        \Log::info('=== DELETE PROCESS COMPLETED ===');
        
        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dihapus!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        \Log::error('Post not found with ID: ' . $id);
        return redirect()->route('admin.pages.index')
            ->with('error', 'Halaman tidak ditemukan!');
            
    } catch (\Exception $e) {
        \Log::error('Delete error: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()->route('admin.pages.index')
            ->with('error', 'Gagal menghapus halaman: ' . $e->getMessage());
    }
}

    // Quick Actions
    public function quickPublish(Post $post)
    {
        $post->update([
            'is_published' => true,
            'published_at' => now()
        ]);

        return back()->with('success', 'Halaman berhasil dipublikasikan!');
    }

    public function quickUnpublish(Post $post)
    {
        $post->update([
            'is_published' => false
        ]);

        return back()->with('success', 'Halaman berhasil di-unpublish!');
    }
}