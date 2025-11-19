@extends('layouts.admin')

@section('page-title', 'Edit Berita')
@section('breadcrumb', 'Edit Berita')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-edit text-primary-600 mr-3"></i>
                Edit Berita
            </h1>
            <p class="text-gray-600 mt-2">Perbarui informasi berita "{{ $post->title }}"</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.posts.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali
            </a>
            
            <a href="{{ route('posts.show', $post->slug) }}" 
               target="_blank"
               class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-eye mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                Preview
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-lg font-semibold {{ $post->is_published ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $post->is_published ? 'Published' : 'Draft' }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-full {{ $post->is_published ? 'bg-green-100' : 'bg-yellow-100' }} flex items-center justify-center">
                    <i class="fas {{ $post->is_published ? 'fa-check text-green-600' : 'fa-clock text-yellow-600' }}"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Kategori</p>
                    <p class="text-lg font-semibold text-primary-600">{{ $post->category->name }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-tag text-primary-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Dibuat</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $post->created_at->format('d M Y') }}</p>
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
                    <p class="text-lg font-semibold text-gray-800">{{ $post->updated_at->format('d M Y') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-sync text-gray-600"></i>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content Column -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-3"></i>
                        Informasi Dasar Berita
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-heading text-primary-600 mr-2"></i>
                                Judul Berita
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   required 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-4 text-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400"
                                   value="{{ old('title', $post->title) }}"
                                   placeholder="Masukkan judul berita yang menarik perhatian pembaca...">
                            @error('title')
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
                                   value="{{ old('slug', $post->slug) }}"
                                   placeholder="judul-berita-seo-friendly">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/berita') }}/<span id="slug-preview">{{ $post->slug }}</span></code>
                            </p>
                        </div>

                        <!-- Category & Featured Image -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <i class="fas fa-tag text-primary-600 mr-2"></i>
                                    Kategori
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="category_id" 
                                        id="category_id" 
                                        required 
                                        class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-white appearance-none">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Featured Image -->
                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <i class="fas fa-image text-primary-600 mr-2"></i>
                                    Gambar Utama
                                </label>
                                
                                <div class="space-y-4">
                                    <!-- Current Image Display -->
                                    @if($post->featured_image)
                                    <div id="current-image-container" class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <p class="text-sm font-medium text-gray-700 flex items-center">
                                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                Gambar Saat Ini
                                            </p>
                                            <span class="text-xs text-gray-500">Klik tombol di bawah untuk mengganti</span>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                    alt="Current featured image" 
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-600">Gambar sudah diupload sebelumnya</p>
                                                <p class="text-xs text-gray-500 mt-1">Ukuran optimal: 1200×630px</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- New Image Upload Area -->
                                    <div id="new-upload-area" class="{{ $post->featured_image ? 'hidden' : '' }}">
                                        <!-- Image Preview for New Upload -->
                                        <div id="image-preview-container" class="hidden mb-4">
                                            <div class="bg-gray-50 border-2 border-dashed border-primary-300 rounded-xl p-4 text-center">
                                                <div class="mb-3">
                                                    <img id="preview-img" class="mx-auto max-h-48 rounded-lg shadow-md object-cover">
                                                </div>
                                                <div class="flex justify-center space-x-3">
                                                    <button type="button" 
                                                            onclick="removeImage()"
                                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 text-sm font-semibold flex items-center">
                                                        <i class="fas fa-trash mr-2"></i>
                                                        Hapus Gambar
                                                    </button>
                                                    <label for="featured_image" 
                                                        class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-200 text-sm font-semibold flex items-center cursor-pointer">
                                                        <i class="fas fa-sync mr-2"></i>
                                                        Ganti Gambar
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload Placeholder -->
                                        <div id="upload-placeholder">
                                            <label for="featured_image" 
                                                class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-400 hover:bg-primary-50 transition duration-300 group">
                                                <div class="space-y-3">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-primary-500 transition duration-200"></i>
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 group-hover:text-primary-600 transition duration-200">
                                                            {{ $post->featured_image ? 'Ganti Gambar Utama' : 'Upload Gambar Utama' }}
                                                        </p>
                                                        <p class="text-sm text-gray-500 mt-1">
                                                            PNG, JPG, JPEG (Rekomendasi: 1200x630px, Max 2MB)
                                                        </p>
                                                    </div>
                                                    <div class="flex justify-center space-x-4 text-xs text-gray-500">
                                                        <span class="flex items-center">
                                                            <i class="fas fa-expand mr-1"></i>1200×630px
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="fas fa-weight-hanging mr-1"></i>Max 2MB
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="fas fa-images mr-1"></i>PNG, JPG, JPEG
                                                        </span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Hidden File Input -->
                                    <input type="file" 
                                        name="featured_image" 
                                        id="featured_image" 
                                        class="hidden"
                                        accept="image/*">
                                </div>
                                
                                @error('featured_image')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-file-alt text-primary-600 mr-3"></i>
                        Konten Berita
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-align-left text-primary-600 mr-2"></i>
                                Ringkasan
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="excerpt" 
                                      id="excerpt" 
                                      required 
                                      rows="4"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400 resize-none"
                                      placeholder="Tulis ringkasan singkat yang menarik tentang berita ini...">{{ old('excerpt', $post->excerpt) }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Ringkasan akan ditampilkan di halaman beranda
                                </p>
                                <span id="excerpt-counter" class="text-xs text-gray-500">{{ strlen($post->excerpt) }}/500</span>
                            </div>
                            @error('excerpt')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-edit text-primary-600 mr-2"></i>
                                Konten Lengkap
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      required 
                                      rows="15"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400 resize-none"
                                      placeholder="Tulis konten berita lengkap di sini...">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-6">
                <!-- Publish Settings Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-paper-plane text-primary-600 mr-3"></i>
                        Pengaturan Publikasi
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Publish Toggle -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="font-medium text-gray-800">Status Publikasi</p>
                                <p class="text-sm text-gray-600">Tampilkan berita di website</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       name="is_published" 
                                       value="1" 
                                       class="sr-only peer"
                                       {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            </label>
                        </div>

                        <!-- Publish Date -->
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="far fa-calendar text-primary-600 mr-2"></i>
                                Jadwal Publikasi
                            </label>
                            <input type="datetime-local" 
                                   name="published_at" 
                                   id="published_at"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-white"
                                   value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <!-- Save Buttons -->
                        <div class="space-y-3 pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center group">
                                <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                Update Berita
                            </button>
                            
                            <a href="{{ route('admin.posts.index') }}" 
                               class="w-full bg-gray-500 text-white py-4 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center justify-center group">
                                <i class="fas fa-times mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Post Information Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-3"></i>
                        Informasi Post
                    </h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">Penulis:</span>
                            <span class="font-semibold text-primary-600">{{ $post->user->name }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-semibold text-gray-800">{{ $post->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">Diupdate:</span>
                            <span class="font-semibold text-gray-800">{{ $post->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if($post->published_at)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">Dipublikasi:</span>
                            <span class="font-semibold text-green-600">{{ $post->published_at->format('d M Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-orange-800 mb-4 flex items-center">
                        <i class="fas fa-bolt text-orange-600 mr-3"></i>
                        Aksi Cepat
                    </h3>
                    
                    <div class="space-y-3">
                        @if($post->is_published)
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_published" value="0">
                            <button type="submit" 
                                    class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition duration-200 font-semibold text-sm flex items-center justify-center">
                                <i class="fas fa-eye-slash mr-2"></i>
                                Unpublish
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_published" value="1">
                            <button type="submit" 
                                    class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition duration-200 font-semibold text-sm flex items-center justify-center">
                                <i class="fas fa-check mr-2"></i>
                                Publish Sekarang
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('posts.show', $post->slug) }}" 
                           target="_blank"
                           class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-200 font-semibold text-sm flex items-center justify-center">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat di Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Auto generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
        document.getElementById('slug-preview').textContent = slug;
    });

    // Character counters
    document.getElementById('excerpt').addEventListener('input', function() {
        const excerpt = this.value;
        const counter = document.getElementById('excerpt-counter');
        
        counter.textContent = `${excerpt.length}/500`;
        
        if (excerpt.length > 500) {
            counter.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
        }
    });

    // Image preview
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const img = document.getElementById('preview-img');
                const placeholder = document.getElementById('upload-placeholder');
                
                img.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Initialize counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        const excerpt = document.getElementById('excerpt').value;
        document.getElementById('excerpt-counter').textContent = `${excerpt.length}/500`;
    });
</script>

<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    input[type="checkbox"]:checked ~ .peer-checked\:bg-primary-600 {
        background-color: #3b82f6;
    }

    input[type="checkbox"]:checked ~ .peer-checked\:after\:translate-x-6::after {
        transform: translateX(1.5rem);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    /* Drag and drop animations */
.scale-95 {
    transform: scale(0.95);
}

/* Smooth transitions for upload area */
label[for="featured_image"] {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Image preview animations */
#image-preview-container {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* File info display */
#image-info {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Hover effects for action buttons */
.bg-primary-600:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.bg-red-500:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}
</style>
@endsection