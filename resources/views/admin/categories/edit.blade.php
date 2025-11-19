@extends('layouts.admin')

@section('page-title', 'Edit Kategori')
@section('breadcrumb', 'Edit Kategori')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-edit text-primary-600 mr-3"></i>
                Edit Kategori
            </h1>
            <p class="text-gray-600 mt-2">Perbarui informasi kategori "{{ $category->name }}"</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.categories.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Category Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Berita</p>
                    <p class="text-2xl font-bold text-primary-600">{{ $category->posts_count }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-newspaper text-primary-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Dibuat</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $category->created_at->format('d M Y') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-calendar text-gray-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Diupdate</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $category->updated_at->format('d M Y') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-sync text-gray-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-3"></i>
                        Informasi Kategori
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Category Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-tag text-primary-600 mr-2"></i>
                                Nama Kategori
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-4 text-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400"
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="Contoh: Teknologi, Politik, Olahraga...">
                            @error('name')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-link text-primary-600 mr-2"></i>
                                Slug URL
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   required 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-100 focus:bg-white placeholder-gray-400 font-mono text-sm"
                                   value="{{ old('slug', $category->slug) }}"
                                   placeholder="teknologi-politik-olahraga">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/kategori') }}/<span id="slug-preview">{{ $category->slug }}</span></code>
                            </p>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-align-left text-primary-600 mr-2"></i>
                                Deskripsi Kategori
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400 resize-none"
                                      placeholder="Jelaskan tujuan dan cakupan kategori ini...">{{ old('description', $category->description) }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Deskripsi opsional untuk penjelasan kategori
                                </p>
                                <span id="description-counter" class="text-xs text-gray-500">{{ strlen($category->description) }}/500</span>
                            </div>
                            @error('description')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                        <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Update Kategori
                    </button>
                    
                    @if($category->posts_count == 0)
                    <button type="button"
                            onclick="confirmDelete()"
                            class="bg-red-500 text-white px-8 py-4 rounded-xl hover:bg-red-600 transition-all duration-300 shadow font-semibold flex items-center group">
                        <i class="fas fa-trash mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Hapus Kategori
                    </button>
                    @else
                    <button class="bg-gray-400 text-white px-8 py-4 rounded-xl cursor-not-allowed font-semibold flex items-center"
                            title="Tidak dapat dihapus karena memiliki {{ $category->posts_count }} berita">
                        <i class="fas fa-lock mr-3"></i>
                        Terkunci
                    </button>
                    @endif
                </div>
            </form>

            <!-- Delete Form (Hidden) -->
            @if($category->posts_count == 0)
            <form id="delete-form" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Category Preview Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-eye text-primary-600 mr-3"></i>
                    Preview Kategori
                </h3>
                
                <div class="space-y-4">
                    <div class="text-center p-4 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl text-white">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-tag text-2xl"></i>
                        </div>
                        <h4 id="preview-name" class="text-xl font-bold">{{ $category->name }}</h4>
                        <p id="preview-slug" class="text-primary-100 text-sm mt-1">{{ $category->slug }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 block mb-2 text-sm font-medium">Deskripsi:</span>
                        <p id="preview-description" class="text-gray-800 text-sm">
                            {{ $category->description ?: 'Tidak ada deskripsi' }}
                        </p>
                    </div>
                    
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600">Total Berita:</span>
                        <span class="font-semibold text-primary-600">{{ $category->posts_count }}</span>
                    </div>
                </div>
            </div>

            <!-- Recent Posts Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-newspaper text-primary-600 mr-3"></i>
                    Berita Terbaru
                </h3>
                
                <div class="space-y-3">
                    @php
                        $recentPosts = $category->posts()->latest()->take(3)->get();
                    @endphp
                    
                    @forelse($recentPosts as $post)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150">
                        <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded flex items-center justify-center">
                            <i class="fas fa-file-alt text-primary-600 text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate">{{ $post->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-inbox text-gray-300 text-2xl mb-2"></i>
                        <p class="text-gray-500 text-sm">Belum ada berita</p>
                    </div>
                    @endforelse
                    
                    @if($category->posts_count > 0)
                    <div class="pt-3 border-t border-gray-200">
                        <a href="{{ route('admin.posts.index') }}?category={{ $category->id }}" 
                           class="block text-center bg-primary-50 text-primary-600 py-2 rounded-lg hover:bg-primary-100 transition duration-200 font-semibold text-sm">
                            Lihat Semua Berita
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-blue-600 mr-3"></i>
                    Tips Edit Kategori
                </h3>
                
                <ul class="space-y-2 text-sm text-blue-700">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Perubahan slug akan mempengaruhi URL yang sudah ada</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Kategori dengan berita tidak dapat dihapus</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-blue-600 text-xs"></i>
                        <span>Deskripsi membantu pengunjung memahami kategori</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
        document.getElementById('slug-preview').textContent = slug;
        
        // Update preview
        document.getElementById('preview-name').textContent = name;
        document.getElementById('preview-slug').textContent = slug;
    });

    // Update slug preview when slug input changes
    document.getElementById('slug').addEventListener('input', function() {
        const slug = this.value;
        document.getElementById('slug-preview').textContent = slug;
        document.getElementById('preview-slug').textContent = slug;
    });

    // Description character counter and preview
    document.getElementById('description').addEventListener('input', function() {
        const description = this.value;
        const counter = document.getElementById('description-counter');
        
        counter.textContent = `${description.length}/500`;
        document.getElementById('preview-description').textContent = description || 'Tidak ada deskripsi';
        
        if (description.length > 500) {
            counter.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
        }
    });

    // Delete confirmation
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus kategori "{{ $category->name }}"? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form').submit();
        }
    }

    // Initialize previews on page load
    document.addEventListener('DOMContentLoaded', function() {
        const description = document.getElementById('description').value;
        document.getElementById('description-counter').textContent = `${description.length}/500`;
    });
</script>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }

    input:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endsection