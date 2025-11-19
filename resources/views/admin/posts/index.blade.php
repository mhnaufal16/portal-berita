@extends('layouts.admin')

@section('page-title', 'Manajemen Berita')
@section('breadcrumb', 'Semua Berita')

@section('content')
<div class="p-6">
    <!-- Header with Stats -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-newspaper text-primary-600 mr-3"></i>
                Manajemen Berita
            </h1>
            <p class="text-gray-600 mt-2">Kelola semua berita dan artikel di portal berita Anda</p>
        </div>
        
        <div class="flex items-center space-x-4 mt-4 lg:mt-0">
            <!-- Quick Stats -->
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ $posts->total() }}</div>
                    <div class="text-gray-500">Total</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ \App\Models\Post::where('is_published', true)->count() }}</div>
                    <div class="text-gray-500">Published</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ \App\Models\Post::where('is_published', false)->count() }}</div>
                    <div class="text-gray-500">Draft</div>
                </div>
            </div>

            <!-- Create Button -->
            <a href="{{ route('admin.posts.create') }}" 
               class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                Buat Berita Baru
            </a>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-6 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <!-- Search Box -->
            <div class="flex-1 lg:max-w-md">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           placeholder="Cari berita..." 
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white">
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-2">
                <button class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-semibold hover:bg-primary-700 transition duration-200 flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Semua
                </button>
                <button class="px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold hover:bg-green-200 transition duration-200 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Published
                </button>
                <button class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg text-sm font-semibold hover:bg-yellow-200 transition duration-200 flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    Draft
                </button>
            </div>
        </div>
    </div>

    <!-- Posts Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-list mr-2 text-primary-600"></i>
                    Daftar Berita
                </h3>
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $posts->firstItem() ?? 0 }}-{{ $posts->lastItem() ?? 0 }} dari {{ $posts->total() }} berita
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-image"></i>
                                <span>Gambar</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-heading"></i>
                                <span>Judul Berita</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-tag"></i>
                                <span>Kategori</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-toggle-on"></i>
                                <span>Status</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar"></i>
                                <span>Tanggal</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-cog"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <tr class="hover:bg-gray-50 transition duration-150 group">
                        <!-- Featured Image -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-newspaper text-gray-400 text-lg"></i>
                                @endif
                            </div>
                        </td>

                        <!-- Title & Excerpt -->
                        <td class="px-6 py-4">
                            <div class="max-w-xs">
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary-600 transition duration-200 line-clamp-2">
                                    {{ $post->title }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                    {{ $post->excerpt }}
                                </p>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    <i class="fas fa-user mr-1"></i>
                                    <span>{{ $post->user->name }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-tag mr-1 text-xs"></i>
                                {{ $post->category->name }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->is_published)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Published
                                </span>
                                @if($post->published_at)
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $post->published_at->format('d M Y') }}
                                </div>
                                @endif
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Draft
                                </span>
                            @endif
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $post->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-gray-400">{{ $post->created_at->format('H:i') }}</span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <!-- View -->
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   target="_blank"
                                   class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-200 transition duration-200 group/tooltip relative"
                                   title="Lihat di Website">
                                    <i class="fas fa-eye text-sm"></i>
                                    <span class="tooltip-text">Preview</span>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-200 transition duration-200 group/tooltip relative"
                                   title="Edit Berita">
                                    <i class="fas fa-edit text-sm"></i>
                                    <span class="tooltip-text">Edit</span>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition duration-200 group/tooltip relative"
                                            onclick="return confirm('Hapus berita ini? Tindakan ini tidak dapat dibatalkan.')"
                                            title="Hapus Berita">
                                        <i class="fas fa-trash text-sm"></i>
                                        <span class="tooltip-text">Hapus</span>
                                    </button>
                                </form>

                                <!-- Quick Actions Dropdown -->
                                <div class="relative group/dropdown">
                                    <button class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center hover:bg-gray-200 transition duration-200">
                                        <i class="fas fa-ellipsis-v text-sm"></i>
                                    </button>
                                    
                                    <div class="absolute right-0 top-full mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-10 opacity-0 invisible group-hover/dropdown:opacity-100 group-hover/dropdown:visible transition-all duration-200">
                                        @if($post->is_published)
                                            <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_published" value="0">
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 flex items-center">
                                                    <i class="fas fa-eye-slash mr-2 text-yellow-600"></i>
                                                    Unpublish
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_published" value="1">
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 flex items-center">
                                                    <i class="fas fa-check mr-2 text-green-600"></i>
                                                    Publish
                                                </button>
                                            </form>
                                        @endif
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 flex items-center">
                                            <i class="fas fa-copy mr-2 text-blue-600"></i>
                                            Duplicate
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                                <p class="text-lg font-medium text-gray-600">Belum ada berita</p>
                                <p class="text-sm mt-2 mb-6">Mulai dengan membuat berita pertama Anda</p>
                                <a href="{{ route('admin.posts.create') }}" 
                                   class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition duration-200 font-semibold inline-flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Buat Berita Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        @if($posts->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $posts->firstItem() ?? 0 }}-{{ $posts->lastItem() ?? 0 }} dari {{ $posts->total() }} berita
                </div>
                <div class="flex items-center space-x-2">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Quick Tips -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-blue-800 mb-2">Tips Manajemen Berita</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Gunakan gambar featured yang menarik untuk meningkatkan engagement</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Pastikan excerpt singkat dan informatif untuk menarik pembaca</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Gunakan kategori untuk mengorganisir konten dengan baik</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tooltip-text {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #1f2937;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s;
        margin-bottom: 5px;
    }

    .group:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
    }

    .group\/tooltip:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
    }

    /* Custom pagination styles */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        margin: 0 2px;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .pagination li a {
        background: white;
        border: 1px solid #e5e7eb;
        color: #6b7280;
    }

    .pagination li a:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }

    .pagination li span {
        background: #3b82f6;
        border: 1px solid #3b82f6;
        color: white;
    }

    .pagination li:first-child a,
    .pagination li:last-child a {
        font-weight: 600;
    }
</style>
@endsection