@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')
@section('breadcrumb', 'Overview')

@section('content')
<div class="p-8">
    <!-- Welcome Section -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Selamat Datang, <span class="gradient-text">{{ Auth::user()->name }}! 👋</span>
        </h1>
        <p class="text-gray-600">Kelola konten portal berita Anda dengan mudah dan efisien.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Posts -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm font-semibold">Total Berita</p>
                    <p class="text-3xl font-bold mt-2">{{ \App\Models\Post::count() }}</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 p-3 rounded-xl">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-blue-100 text-sm">
                <i class="fas fa-trending-up mr-1"></i>
                <span>{{ \App\Models\Post::whereDate('created_at', today())->count() }} baru hari ini</span>
            </div>
        </div>

        <!-- Published Posts -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-100 text-sm font-semibold">Berita Published</p>
                    <p class="text-3xl font-bold mt-2">{{ \App\Models\Post::where('is_published', true)->count() }}</p>
                </div>
                <div class="bg-green-400 bg-opacity-30 p-3 rounded-xl">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-green-100 text-sm">
                <i class="fas fa-eye mr-1"></i>
                <span>{{ round((\App\Models\Post::where('is_published', true)->count() / max(\App\Models\Post::count(), 1)) * 100) }}% terpublikasi</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm font-semibold">Total Kategori</p>
                    <p class="text-3xl font-bold mt-2">{{ \App\Models\Category::count() }}</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 p-3 rounded-xl">
                    <i class="fas fa-tags text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-purple-100 text-sm">
                <i class="fas fa-layer-group mr-1"></i>
                <span>Organisasi konten</span>
            </div>
        </div>

        <!-- Pages -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-orange-100 text-sm font-semibold">Halaman</p>
                    <p class="text-3xl font-bold mt-2">{{ \App\Models\Page::count() }}</p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 p-3 rounded-xl">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-orange-100 text-sm">
                <i class="fas fa-browser mr-1"></i>
                <span>Halaman statis</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                    Aksi Cepat
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.posts.create') }}" 
                       class="group bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5 hover:from-blue-100 hover:to-blue-200 transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-500 text-white p-3 rounded-lg group-hover:scale-110 transition duration-300">
                                <i class="fas fa-plus text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Buat Berita</h4>
                                <p class="text-sm text-gray-600 mt-1">Tulis berita baru</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.categories.create') }}" 
                       class="group bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-5 hover:from-green-100 hover:to-green-200 transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-500 text-white p-3 rounded-lg group-hover:scale-110 transition duration-300">
                                <i class="fas fa-tag text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Tambah Kategori</h4>
                                <p class="text-sm text-gray-600 mt-1">Buat kategori baru</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.pages.create') }}" 
                       class="group bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-5 hover:from-purple-100 hover:to-purple-200 transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-purple-500 text-white p-3 rounded-lg group-hover:scale-110 transition duration-300">
                                <i class="fas fa-file-alt text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Buat Halaman</h4>
                                <p class="text-sm text-gray-600 mt-1">Tambah halaman statis</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.posts.index') }}" 
                       class="group bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-5 hover:from-orange-100 hover:to-orange-200 transition-all duration-300 transform hover:scale-105 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-orange-500 text-white p-3 rounded-lg group-hover:scale-110 transition duration-300">
                                <i class="fas fa-list text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Kelola Berita</h4>
                                <p class="text-sm text-gray-600 mt-1">Lihat semua berita</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-history text-primary-600 mr-3"></i>
                Aktivitas Terbaru
            </h3>

            <div class="space-y-4">
                @php
                    $recentPosts = \App\Models\Post::with(['category', 'user'])
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                @forelse($recentPosts as $post)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-primary-600 text-sm"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $post->title }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-gray-500">{{ $post->category->name }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <span class="flex-shrink-0 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $post->is_published ? 'Live' : 'Draft' }}
                    </span>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500 text-sm">Belum ada aktivitas</p>
                </div>
                @endforelse
            </div>

            @if($recentPosts->count() > 0)
            <div class="mt-6 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.posts.index') }}" 
                   class="block text-center bg-primary-50 text-primary-600 py-2 rounded-lg hover:bg-primary-100 transition duration-200 font-semibold text-sm">
                    Lihat Semua Aktivitas
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- System Status -->
    <div class="mt-8 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl p-6 text-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold flex items-center">
                <i class="fas fa-server mr-3 text-green-400"></i>
                Status Sistem
            </h3>
            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center">
                <i class="fas fa-circle text-xs mr-2 animate-pulse"></i>
                Online
            </span>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div>
                <p class="text-gray-400 text-sm">Laravel</p>
                <p class="font-semibold">{{ app()->version() }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Environment</p>
                <p class="font-semibold text-green-400">{{ app()->environment() }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Timezone</p>
                <p class="font-semibold">{{ config('app.timezone') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Debug</p>
                <p class="font-semibold {{ config('app.debug') ? 'text-yellow-400' : 'text-green-400' }}">
                    {{ config('app.debug') ? 'ON' : 'OFF' }}
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>
@endsection