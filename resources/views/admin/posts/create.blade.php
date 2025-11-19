@extends('layouts.admin')

@section('page-title', 'Tambah Berita Baru')
@section('breadcrumb', 'Buat Berita')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-plus-circle text-primary-600 mr-3"></i>
                Tambah Berita Baru
            </h1>
            <p class="text-gray-600 mt-2">Buat berita menarik untuk dibaca pengunjung website Anda</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.posts.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-6 shadow-sm">
        <div class="flex items-center justify-between max-w-2xl mx-auto">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-semibold shadow-lg">
                    1
                </div>
                <span class="text-sm font-medium text-primary-600 mt-2">Informasi Dasar</span>
            </div>
            <div class="flex-1 h-1 bg-primary-600 mx-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 text-white rounded-full flex items-center justify-center font-semibold">
                    2
                </div>
                <span class="text-sm font-medium text-gray-500 mt-2">Konten</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300 mx-4"></div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 text-white rounded-full flex items-center justify-center font-semibold">
                    3
                </div>
                <span class="text-sm font-medium text-gray-500 mt-2">Publikasi</span>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
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
                                   value="{{ old('title') }}"
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
                                   value="{{ old('slug') }}"
                                   placeholder="judul-berita-seo-friendly">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL akan menjadi: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/berita') }}/<span id="slug-preview">judul-berita</span></code>
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <!-- Image Preview Area -->
                                        <div id="image-preview-container" class="hidden">
                                            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-4 text-center">
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
                                                class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-primary-400 hover:bg-primary-50 transition duration-300 group">
                                                <div class="space-y-3">
                                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-primary-500 transition duration-200"></i>
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 group-hover:text-primary-600 transition duration-200">
                                                            Klik untuk Upload Gambar
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
                                      placeholder="Tulis ringkasan singkat yang menarik tentang berita ini...">{{ old('excerpt') }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Ringkasan akan ditampilkan di halaman beranda
                                </p>
                                <span id="excerpt-counter" class="text-xs text-gray-500">0/500</span>
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
                                      placeholder="Tulis konten berita lengkap di sini...">{{ old('content') }}</textarea>
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
                                       {{ old('is_published') ? 'checked' : '' }}>
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
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-white">
                        </div>

                        <!-- Save Buttons -->
                        <div class="space-y-3 pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    name="action" 
                                    value="publish"
                                    class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center group">
                                <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                Simpan & Publikasikan
                            </button>
                            
                            <button type="submit" 
                                    name="action" 
                                    value="draft"
                                    class="w-full bg-gray-500 text-white py-4 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center justify-center group">
                                <i class="fas fa-file-alt mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                Simpan sebagai Draft
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tips & Guidelines Card -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                        <i class="fas fa-lightbulb text-blue-600 mr-3"></i>
                        Tips Menulis
                    </h3>
                    
                    <ul class="space-y-3 text-sm text-blue-700">
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                            <span>Gunakan judul yang menarik dan deskriptif</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                            <span>Ringkasan harus mencerminkan isi konten</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                            <span>Pilih gambar utama yang relevan dan menarik</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                            <span>Gunakan kategori yang sesuai untuk organisasi</span>
                        </li>
                    </ul>
                </div>

                <!-- Character Counter Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-primary-600 mr-3"></i>
                        Statistik Konten
                    </h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Karakter Judul:</span>
                            <span id="title-counter" class="font-semibold text-primary-600">0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Karakter Ringkasan:</span>
                            <span id="excerpt-length" class="font-semibold text-primary-600">0/500</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Kata Konten:</span>
                            <span id="content-counter" class="font-semibold text-primary-600">0</span>
                        </div>
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
        
        // Update title counter
        document.getElementById('title-counter').textContent = title.length;
    });

    // Character counters
    document.getElementById('excerpt').addEventListener('input', function() {
        const excerpt = this.value;
        const counter = document.getElementById('excerpt-counter');
        const lengthDisplay = document.getElementById('excerpt-length');
        
        counter.textContent = `${excerpt.length}/500`;
        lengthDisplay.textContent = `${excerpt.length}/500`;
        
        if (excerpt.length > 500) {
            counter.classList.add('text-red-500');
            lengthDisplay.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
            lengthDisplay.classList.remove('text-red-500');
        }
    });

    document.getElementById('content').addEventListener('input', function() {
        const content = this.value;
        const wordCount = content.trim() ? content.trim().split(/\s+/).length : 0;
        document.getElementById('content-counter').textContent = wordCount;
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
        const title = document.getElementById('title').value;
        const excerpt = document.getElementById('excerpt').value;
        const content = document.getElementById('content').value;
        
        document.getElementById('title-counter').textContent = title.length;
        document.getElementById('excerpt-counter').textContent = `${excerpt.length}/500`;
        document.getElementById('excerpt-length').textContent = `${excerpt.length}/500`;
        document.getElementById('content-counter').textContent = content.trim() ? content.trim().split(/\s+/).length : 0;
        
        // Initialize slug preview
        const slug = document.getElementById('slug').value || 'judul-berita';
        document.getElementById('slug-preview').textContent = slug;
    });

    // Add smooth focus transitions
    const inputs = document.querySelectorAll('input, textarea, select');
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
    /* Custom select arrow */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Custom checkbox toggle */
    input[type="checkbox"]:checked ~ .peer-checked\:bg-primary-600 {
        background-color: #3b82f6;
    }

    input[type="checkbox"]:checked ~ .peer-checked\:after\:translate-x-6::after {
        transform: translateX(1.5rem);
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Focus styles */
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