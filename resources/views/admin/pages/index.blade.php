@extends('layouts.admin')

@section('page-title', 'Manajemen Halaman')
@section('breadcrumb', 'Semua Halaman')

@section('content')
<div class="p-6">
    <!-- Header dengan informasi saja -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-alt text-primary-600 mr-3"></i>
                Profile Perusahaan
            </h1>
            <p class="text-gray-600 mt-2">Kelola halaman profile perusahaan</p>
        </div>
        
        <div class="flex items-center space-x-4 mt-4 lg:mt-0">
            <!-- Quick Stats -->
            <div class="hidden md:flex items-center space-x-6 text-sm">
                <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ $pages->total() }}</div>
                    <div class="text-gray-500">Total</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $pages->where('is_published', true)->count() }}</div>
                    <div class="text-gray-500">Published</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $pages->where('is_published', false)->count() }}</div>
                    <div class="text-gray-500">Draft</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-blue-800 mb-2">Informasi Halaman</h4>
                <p class="text-blue-700 text-sm">
                    Halaman profile perusahaan dapat diakses di: 
                    <code class="bg-blue-100 px-2 py-1 rounded ml-1">{{ url('/profile-perusahaan') }}</code>
                </p>
            </div>
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
                    <a href="{{ url('/profile-perusahaan') }}" 
                       target="_blank"
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition duration-200"
                       title="Lihat di Website">
                        <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                        Lihat
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
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Halaman Profile</h3>
                    <p class="text-gray-500 mb-6">Halaman profile perusahaan akan dibuat otomatis.</p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <p class="text-yellow-700 text-sm">
                            Akses <code class="bg-yellow-100 px-2 py-1 rounded">{{ url('/profile-perusahaan') }}</code> 
                            untuk melihat halaman profile default.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
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