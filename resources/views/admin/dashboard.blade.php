@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Dashboard Admin</h2>
    <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Total Berita</p>
                <p class="text-3xl font-bold">{{ \App\Models\Post::count() }}</p>
            </div>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v12m0 0h6m-6 0h6"></path>
            </svg>
        </div>
    </div>

    <div class="bg-green-500 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Berita Published</p>
                <p class="text-3xl font-bold">{{ \App\Models\Post::where('is_published', true)->count() }}</p>
            </div>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>

    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Total Kategori</p>
                <p class="text-3xl font-bold">{{ \App\Models\Category::count() }}</p>
            </div>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
        </div>
    </div>

    <div class="bg-purple-500 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Halaman</p>
                <p class="text-3xl font-bold">{{ \App\Models\Page::count() }}</p>
            </div>
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-4">Aksi Cepat</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.posts.create') }}" class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700">
                + Buat Berita Baru
            </a>
            <a href="{{ route('admin.categories.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700">
                + Tambah Kategori
            </a>
            <a href="{{ route('admin.pages.create') }}" class="block w-full bg-purple-600 text-white text-center py-2 px-4 rounded hover:bg-purple-700">
                + Buat Halaman
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-4">Berita Terbaru</h3>
        @php
            $recentPosts = \App\Models\Post::with('category')->latest()->take(5)->get();
        @endphp
        @if($recentPosts->count() > 0)
            <div class="space-y-3">
                @foreach($recentPosts as $post)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-medium">{{ Str::limit($post->title, 40) }}</p>
                        <p class="text-sm text-gray-600">{{ $post->category->name }} • {{ $post->created_at->format('d/m/Y') }}</p>
                    </div>
                    <span class="bg-{{ $post->is_published ? 'green' : 'yellow' }}-100 text-{{ $post->is_published ? 'green' : 'yellow' }}-800 px-2 py-1 rounded text-xs">
                        {{ $post->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Belum ada berita.</p>
        @endif
    </div>
</div>
@endsection