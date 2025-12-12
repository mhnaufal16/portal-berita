@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')
@section('breadcrumb', 'Overview')

@section('content')
<div class="p-8">
    <!-- Welcome Section -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-[#1b1b18] mb-2 tracking-tight">
            Selamat Datang, <span class="gradient-text">{{ Auth::user()->name }}! 👋</span>
        </h1>
        <p class="text-[#706f6c]">Kelola konten Perisai Demokrasi Bangsa Anda dengan mudah dan efisien.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Posts -->
        <div class="bg-white rounded-xl p-6 border border-[#e3e3e0] shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fas fa-newspaper text-6xl text-[#1b1b18]"></i>
            </div>
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#706f6c] text-sm font-medium mb-1">Total Berita</p>
                    <p class="text-3xl font-bold text-[#1b1b18]">{{ \App\Models\Post::count() }}</p>
                </div>
                <div class="bg-[#1b1b18] text-white w-10 h-10 rounded-lg flex items-center justify-center shadow-lg shadow-black/10">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-emerald-600 text-sm font-medium">
                <i class="fas fa-trending-up mr-1.5"></i>
                <span class="bg-emerald-50 px-2 py-0.5 rounded-full">{{ \App\Models\Post::whereDate('created_at', today())->count() }} baru hari ini</span>
            </div>
        </div>

        <!-- Published Posts -->
        <div class="bg-white rounded-xl p-6 border border-[#e3e3e0] shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fas fa-check-circle text-6xl text-amber-500"></i>
            </div>
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#706f6c] text-sm font-medium mb-1">Berita Published</p>
                    <p class="text-3xl font-bold text-[#1b1b18]">{{ \App\Models\Post::where('is_published', true)->count() }}</p>
                </div>
                <div class="bg-amber-500 text-white w-10 h-10 rounded-lg flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-[#706f6c] text-sm">
                <div class="w-full bg-gray-100 rounded-full h-1.5 mr-2">
                    <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ (\App\Models\Post::count() > 0) ? round((\App\Models\Post::where('is_published', true)->count() / \App\Models\Post::count()) * 100) : 0 }}%"></div>
                </div>
                <span class="text-xs whitespace-nowrap">{{ (\App\Models\Post::count() > 0) ? round((\App\Models\Post::where('is_published', true)->count() / \App\Models\Post::count()) * 100) : 0 }}%</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-xl p-6 border border-[#e3e3e0] shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fas fa-tags text-6xl text-blue-600"></i>
            </div>
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#706f6c] text-sm font-medium mb-1">Total Kategori</p>
                    <p class="text-3xl font-bold text-[#1b1b18]">{{ \App\Models\Category::count() }}</p>
                </div>
                <div class="bg-blue-600 text-white w-10 h-10 rounded-lg flex items-center justify-center shadow-lg shadow-blue-600/20">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-blue-600 text-sm font-medium">
                <i class="fas fa-folder mr-1.5"></i>
                <span>Organisasi konten</span>
            </div>
        </div>

        <!-- Pages -->
        <div class="bg-white rounded-xl p-6 border border-[#e3e3e0] shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fas fa-file-alt text-6xl text-purple-600"></i>
            </div>
            <div class="flex justify-between items-start z-10 relative">
                <div>
                    <p class="text-[#706f6c] text-sm font-medium mb-1">Halaman</p>
                    <p class="text-3xl font-bold text-[#1b1b18]">{{ \App\Models\Page::count() }}</p>
                </div>
                <div class="bg-purple-600 text-white w-10 h-10 rounded-lg flex items-center justify-center shadow-lg shadow-purple-600/20">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-purple-600 text-sm font-medium">
                <i class="fas fa-browser mr-1.5"></i>
                <span>Halaman statis</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-[#e3e3e0] p-6 shadow-sm">
                <h3 class="text-lg font-bold text-[#1b1b18] mb-6 flex items-center">
                    <span class="bg-amber-100 text-amber-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">
                        <i class="fas fa-bolt"></i>
                    </span>
                    Aksi Cepat
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.posts.create') }}" 
                       class="group bg-[#FDFDFC] border border-[#e3e3e0] rounded-xl p-5 hover:border-amber-300 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-[#1b1b18] text-white p-3 rounded-lg group-hover:bg-amber-500 transition duration-300 shadow-md">
                                <i class="fas fa-plus text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#1b1b18]">Buat Berita</h4>
                                <p class="text-sm text-[#706f6c] mt-0.5">Tulis berita baru</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.categories.create') }}" 
                       class="group bg-[#FDFDFC] border border-[#e3e3e0] rounded-xl p-5 hover:border-amber-300 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white border border-[#e3e3e0] text-[#1b1b18] p-3 rounded-lg group-hover:bg-[#1b1b18] group-hover:text-white transition duration-300 shadow-sm">
                                <i class="fas fa-tag text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#1b1b18]">Tambah Kategori</h4>
                                <p class="text-sm text-[#706f6c] mt-0.5">Buat kategori baru</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.posts.index') }}" 
                       class="group bg-[#FDFDFC] border border-[#e3e3e0] rounded-xl p-5 hover:border-amber-300 transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white border border-[#e3e3e0] text-[#1b1b18] p-3 rounded-lg group-hover:bg-[#1b1b18] group-hover:text-white transition duration-300 shadow-sm">
                                <i class="fas fa-list text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#1b1b18]">Kelola Berita</h4>
                                <p class="text-sm text-[#706f6c] mt-0.5">Lihat semua berita</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl border border-[#e3e3e0] p-6 shadow-sm">
            <h3 class="text-lg font-bold text-[#1b1b18] mb-6 flex items-center">
                <span class="bg-gray-100 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">
                    <i class="fas fa-history"></i>
                </span>
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
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-[#FDFDFC] border border-transparent hover:border-[#e3e3e0] transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-[#706f6c] text-sm"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-[#1b1b18] truncate">{{ $post->title }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-xs text-[#706f6c] bg-gray-100 px-1.5 py-0.5 rounded">{{ $post->category->name }}</span>
                            <span class="text-xs text-[#e3e3e0]">•</span>
                            <span class="text-xs text-[#706f6c]">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-gray-200 text-4xl mb-3"></i>
                    <p class="text-[#706f6c] text-sm">Belum ada aktivitas</p>
                </div>
                @endforelse
            </div>

            @if($recentPosts->count() > 0)
            <div class="mt-6 pt-4 border-t border-[#e3e3e0]">
                <a href="{{ route('admin.posts.index') }}" 
                   class="block text-center bg-[#1b1b18] text-white py-2.5 rounded-lg hover:bg-black transition duration-200 font-medium text-sm shadow-md shadow-black/5">
                    Lihat Semua Aktivitas
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- System Status -->
    <div class="mt-8 bg-[#1b1b18] rounded-xl p-6 text-white shadow-lg shadow-black/5">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-server mr-3 text-emerald-400"></i>
                Status Sistem
            </h3>
            <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full text-xs font-medium flex items-center">
                <i class="fas fa-circle text-[8px] mr-2 animate-pulse"></i>
                System Operational
            </span>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-white/10">
            <div>
                <p class="text-[#A1A09A] text-xs uppercase tracking-wider mb-1">Laravel Version</p>
                <p class="font-mono font-semibold">{{ app()->version() }}</p>
            </div>
            <div>
                <p class="text-[#A1A09A] text-xs uppercase tracking-wider mb-1">Environment</p>
                <p class="font-mono font-semibold text-amber-400 capitalize">{{ app()->environment() }}</p>
            </div>
            <div>
                <p class="text-[#A1A09A] text-xs uppercase tracking-wider mb-1">Timezone</p>
                <p class="font-mono font-semibold">{{ config('app.timezone') }}</p>
            </div>
            <div>
                <p class="text-[#A1A09A] text-xs uppercase tracking-wider mb-1">Debug Mode</p>
                <p class="font-mono font-semibold {{ config('app.debug') ? 'text-amber-400' : 'text-emerald-400' }}">
                    {{ config('app.debug') ? 'ENABLED' : 'DISABLED' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection