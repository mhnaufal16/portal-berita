@extends('layouts.admin')

@section('page-title', 'Manajemen Kategori')
@section('breadcrumb', 'Semua Kategori')

@section('content')
<div class="p-6">
    <!-- Header with Stats -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-tags text-primary-600 mr-3"></i>
                Manajemen Kategori
            </h1>
            <p class="text-gray-600 mt-2">Kelola kategori untuk mengorganisir berita dengan baik</p>
        </div>
        
        <div class="flex items-center space-x-4 mt-4 lg:mt-0">
            <!-- Quick Stats -->
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ $categories->total() }}</div>
                    <div class="text-gray-500">Total</div>
                </div>
                <div class="text-center">
                    @php
                        $totalPosts = \App\Models\Post::count();
                        $categoriesWithPosts = \App\Models\Category::has('posts')->count();
                    @endphp
                    <div class="text-2xl font-bold text-green-600">{{ $categoriesWithPosts }}</div>
                    <div class="text-gray-500">Digunakan</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $totalPosts }}</div>
                    <div class="text-gray-500">Total Berita</div>
                </div>
            </div>

            <!-- Create Button -->
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse($categories as $category)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
            <!-- Category Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition duration-200 truncate">
                        {{ $category->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 truncate">{{ $category->slug }}</p>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                        <i class="fas fa-newspaper mr-1 text-xs"></i>
                        {{ $category->posts_count }}
                    </span>
                </div>
            </div>

            <!-- Description -->
            @if($category->description)
            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                {{ $category->description }}
            </p>
            @else
            <p class="text-sm text-gray-400 mb-4 italic">Tidak ada deskripsi</p>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div class="text-xs text-gray-500">
                    <i class="far fa-calendar mr-1"></i>
                    {{ $category->created_at->format('d M Y') }}
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Edit -->
                    <a href="{{ route('admin.categories.edit', $category) }}" 
                       class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-200 transition duration-200 group/tooltip relative"
                       title="Edit Kategori">
                        <i class="fas fa-edit text-sm"></i>
                        <span class="tooltip-text">Edit</span>
                    </a>

                    <!-- Delete -->
                    @if($category->posts_count == 0)
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition duration-200 group/tooltip relative"
                                onclick="return confirm('Hapus kategori ini?')"
                                title="Hapus Kategori">
                            <i class="fas fa-trash text-sm"></i>
                            <span class="tooltip-text">Hapus</span>
                        </button>
                    </form>
                    @else
                    <button class="w-8 h-8 bg-gray-100 text-gray-400 rounded-lg flex items-center justify-center cursor-not-allowed group/tooltip relative"
                            title="Tidak dapat dihapus (memiliki berita)">
                        <i class="fas fa-trash text-sm"></i>
                        <span class="tooltip-text">Terkunci</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tags text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Kategori</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan membuat kategori pertama untuk mengorganisir berita Anda</p>
                    <a href="{{ route('admin.categories.create') }}" 
                       class="bg-primary-600 text-white px-8 py-3 rounded-xl hover:bg-primary-700 transition duration-200 font-semibold inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Kategori Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Traditional Table View (Alternative) -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-table mr-2 text-primary-600"></i>
                    Tabel Kategori
                </h3>
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $categories->count() }} kategori
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
                                <i class="fas fa-tag"></i>
                                <span>Nama Kategori</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-link"></i>
                                <span>Slug</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-newspaper"></i>
                                <span>Jumlah Berita</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar"></i>
                                <span>Dibuat</span>
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
                    @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-tag text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $category->name }}</div>
                                    @if($category->description)
                                    <div class="text-sm text-gray-500 line-clamp-1">{{ $category->description }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $category->posts_count > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                <i class="fas fa-newspaper mr-1 text-xs"></i>
                                {{ $category->posts_count }} berita
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $category->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                   class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 font-semibold text-sm flex items-center">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                
                                @if($category->posts_count == 0)
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 font-semibold text-sm flex items-center"
                                            onclick="return confirm('Hapus kategori {{ $category->name }}?')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <button class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed font-semibold text-sm flex items-center"
                                        title="Tidak dapat dihapus karena memiliki berita">
                                    <i class="fas fa-lock mr-2"></i>
                                    Terkunci
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        @if($categories->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $categories->firstItem() ?? 0 }}-{{ $categories->lastItem() ?? 0 }} dari {{ $categories->total() }} kategori
                </div>
                <div class="flex items-center space-x-2">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Usage Statistics -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-pie text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-blue-800 mb-3">Statistik Penggunaan Kategori</h4>
                
                @php
                    $totalPosts = \App\Models\Post::count();
                    $categoriesWithPosts = \App\Models\Category::has('posts')->get();
                @endphp
                
                @if($totalPosts > 0)
                <div class="space-y-3">
                    @foreach($categoriesWithPosts as $cat)
                    @php
                        $percentage = $totalPosts > 0 ? round(($cat->posts_count / $totalPosts) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-blue-700">{{ $cat->name }}</span>
                            <span class="text-sm text-blue-600 font-semibold">{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-blue-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" 
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="text-xs text-blue-500 mt-1">
                            {{ $cat->posts_count }} berita
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-blue-600 text-sm">Belum ada berita yang menggunakan kategori.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Tips -->
    <div class="mt-6 bg-white rounded-2xl border border-gray-200 p-6">
        <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 mr-3"></i>
            Tips Manajemen Kategori
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3 flex-shrink-0"></i>
                <span>Gunakan nama kategori yang jelas dan deskriptif</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3 flex-shrink-0"></i>
                <span>Hindari duplikasi kategori dengan fungsi serupa</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3 flex-shrink-0"></i>
                <span>Gunakan slug yang SEO-friendly (huruf kecil, hyphen)</span>
            </div>
            <div class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3 flex-shrink-0"></i>
                <span>Tambahkan deskripsi untuk menjelaskan tujuan kategori</span>
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

    /* Progress bar animation */
    .transition-all {
        transition: all 0.5s ease-in-out;
    }
</style>
@endsection