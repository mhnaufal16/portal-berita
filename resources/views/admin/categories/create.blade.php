@extends('layouts.admin')

@section('page-title', 'Tambah Kategori Baru')
@section('breadcrumb', 'Buat Kategori')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-plus-circle text-primary-600 mr-3"></i>
                Tambah Kategori Baru
            </h1>
            <p class="text-gray-600 mt-2">Buat kategori baru untuk mengorganisir berita Anda</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.categories.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf
                
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
                                   value="{{ old('name') }}"
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
                                   value="{{ old('slug') }}"
                                   placeholder="teknologi-politik-olahraga">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL akan menjadi: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/kategori') }}/<span id="slug-preview">nama-kategori</span></code>
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
                                      placeholder="Jelaskan tujuan dan cakupan kategori ini...">{{ old('description') }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Deskripsi opsional untuk penjelasan kategori
                                </p>
                                <span id="description-counter" class="text-xs text-gray-500">0/500</span>
                            </div>
                            @error('description')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                        <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Simpan Kategori
                    </button>
                    
                    <a href="{{ route('admin.categories.index') }}" 
                       class="bg-gray-500 text-white px-8 py-4 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                        <i class="fas fa-times mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-blue-600 mr-3"></i>
                    Tips Kategori
                </h3>
                
                <ul class="space-y-3 text-sm text-blue-700">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Gunakan nama yang singkat dan jelas</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Slug otomatis dari nama kategori</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Deskripsi membantu memahami tujuan kategori</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Hindari kategori yang tumpang tindih</span>
                    </li>
                </ul>
            </div>

            <!-- Preview Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-eye text-primary-600 mr-3"></i>
                    Preview Kategori
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Nama:</span>
                        <span id="preview-name" class="font-semibold text-primary-600">-</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Slug:</span>
                        <span id="preview-slug" class="font-mono text-primary-600">-</span>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600 block mb-2">Deskripsi:</span>
                        <span id="preview-description" class="text-gray-800">-</span>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-primary-600 mr-3"></i>
                    Statistik
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Kategori:</span>
                        <span class="font-semibold text-primary-600">{{ \App\Models\Category::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Kategori Aktif:</span>
                        <span class="font-semibold text-green-600">{{ \App\Models\Category::has('posts')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Berita:</span>
                        <span class="font-semibold text-blue-600">{{ \App\Models\Post::count() }}</span>
                    </div>
                </div>
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
        document.getElementById('preview-name').textContent = name || '-';
        document.getElementById('preview-slug').textContent = slug || '-';
    });

    // Update slug preview when slug input changes
    document.getElementById('slug').addEventListener('input', function() {
        const slug = this.value;
        document.getElementById('slug-preview').textContent = slug;
        document.getElementById('preview-slug').textContent = slug || '-';
    });

    // Description character counter and preview
    document.getElementById('description').addEventListener('input', function() {
        const description = this.value;
        const counter = document.getElementById('description-counter');
        
        counter.textContent = `${description.length}/500`;
        document.getElementById('preview-description').textContent = description || '-';
        
        if (description.length > 500) {
            counter.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
        }
    });

    // Initialize previews on page load
    document.addEventListener('DOMContentLoaded', function() {
        const name = document.getElementById('name').value;
        const slug = document.getElementById('slug').value;
        const description = document.getElementById('description').value;
        
        document.getElementById('preview-name').textContent = name || '-';
        document.getElementById('preview-slug').textContent = slug || '-';
        document.getElementById('preview-description').textContent = description || '-';
        document.getElementById('description-counter').textContent = `${description.length}/500`;
    });

    // Add smooth focus transitions
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-primary-200');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-primary-200');
        });
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