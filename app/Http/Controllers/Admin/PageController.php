<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages',
            'content' => 'required',
        ]);

        try {
            Page::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'is_published' => $request->boolean('is_published', true),
            ]);

            return redirect()->route('admin.pages.index')
                ->with('success', 'Halaman berhasil dibuat!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'content' => 'required',
        ]);

        try {
            $page->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'is_published' => $request->boolean('is_published'),
            ]);

            return redirect()->route('admin.pages.index')
                ->with('success', 'Halaman berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return redirect()->route('admin.pages.index')
                ->with('success', 'Halaman berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.index')
                ->with('error', 'Gagal menghapus halaman: ' . $e->getMessage());
        }
    }

     // Quick Actions
    public function quickPublish(Page $page)
    {
        $page->update([
            'is_published' => true
        ]);

        return back()->with('success', 'Halaman berhasil dipublikasikan!');
    }

    public function quickUnpublish(Page $page)
    {
        $page->update([
            'is_published' => false
        ]);

        return back()->with('success', 'Halaman berhasil di-unpublish!');
    }
}