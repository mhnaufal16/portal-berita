@extends('layouts.admin')

@section('page-title', 'Manajemen Halaman')
@section('breadcrumb', 'Semua Halaman')

@section('content')
<div class="p-6">
    <!-- Header with Stats -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-alt text-primary-600 mr-3"></i>
                Manajemen Halaman
            </h1>
            <p class="text-gray-600 mt-2">Kelola halaman statis seperti Profile Perusahaan, Kontak, dll.</p>
        </div>
        
        <div class="flex items-center space-x-4 mt-4 lg:mt-0">
            <!-- Quick Stats -->
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ $pages->total() }}</div>
                    <div class="text-gray-500">Total</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ \App\Models\Page::where('is_published', true)->count() }}</div>
                    <div class="text-gray-500">Published</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ \App\Models\Page::where('is_published', false)->count() }}</div>
                    <div class="text-gray-500">Draft</div>
                </div>
            </div>

            <!-- Create Button -->
            <a href="{{ route('admin.pages.create') }}" 
               class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                Tambah Halaman
            </a>
        </div>
    </div>

    <!-- Pages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($pages as $page)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
            <!-- Page Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition duration-200 truncate">
                        {{ $page->title }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-1 truncate">
                        <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $page->slug }}</code>
                    </p>
                </div>
                <div class="flex-shrink-0 ml-3">
                    @if($page->is_published)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Live
                    </span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Draft
                    </span>
                    @endif
                </div>
            </div>

            <!-- Content Preview -->
            <div class="mb-4">
                <p class="text-sm text-gray-600 line-clamp-3">
                    @if(strip_tags($page->content))
                        {{ Str::limit(strip_tags($page->content), 120) }}
                    @else
                        <span class="text-gray-400 italic">Tidak ada konten</span>
                    @endif
                </p>
            </div>

            <!-- Page Info -->
            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                <div class="flex items-center space-x-4">
                    <span>
                        <i class="far fa-calendar mr-1"></i>
                        {{ $page->created_at->format('d M Y') }}
                    </span>
                    <span>
                        <i class="far fa-clock mr-1"></i>
                        {{ $page->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div class="flex items-center space-x-2">
                    @if($page->is_published)
                    <a href="{{ url('/' . $page->slug) }}" 
                       target="_blank"
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition duration-200"
                       title="Lihat di Website">
                        <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                        View
                    </a>
                    @endif
                </div>
                
                <div class="flex items-center space-x-2">
                    <!-- Edit -->
                    <a href="{{ route('admin.pages.edit', $page) }}" 
                       class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-200 transition duration-200 group/tooltip relative"
                       title="Edit Halaman">
                        <i class="fas fa-edit text-sm"></i>
                        <span class="tooltip-text">Edit</span>
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition duration-200 group/tooltip relative"
                                onclick="return confirm('Hapus halaman ini?')"
                                title="Hapus Halaman">
                            <i class="fas fa-trash text-sm"></i>
                            <span class="tooltip-text">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Halaman</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan membuat halaman pertama untuk website Anda</p>
                    <a href="{{ route('admin.pages.create') }}" 
                       class="bg-primary-600 text-white px-8 py-3 rounded-xl hover:bg-primary-700 transition duration-200 font-semibold inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Halaman Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Quick Tips -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-blue-800 mb-3">Tips Manajemen Halaman</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-blue-700">
                    <div class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 text-xs flex-shrink-0"></i>
                        <span>Gunakan slug yang deskriptif dan SEO-friendly</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 text-xs flex-shrink-0"></i>
                        <span>Halaman published akan bisa diakses publik</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 text-xs flex-shrink-0"></i>
                        <span>Gunakan konten yang informatif dan lengkap</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 text-xs flex-shrink-0"></i>
                        <span>Review konten sebelum mempublikasikan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
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
</style>
@endsection