@extends('layouts.admin')

@section('page-title', 'Edit Halaman')
@section('breadcrumb', 'Edit Halaman')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-edit text-primary-600 mr-3"></i>
                Edit Halaman
            </h1>
            <p class="text-gray-600 mt-2">Perbarui konten dan pengaturan halaman</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.pages.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-600"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-exclamation-circle mr-3 text-red-600"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-3"></i>
                        Informasi Halaman
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Page Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-heading text-primary-600 mr-2"></i>
                                Judul Halaman
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   required 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-4 text-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400"
                                   value="{{ old('title', $page->title) }}"
                                   placeholder="Contoh: Tentang Kami, Kontak, Visi Misi...">
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
                                   value="{{ old('slug', $page->slug) }}"
                                   placeholder="tentang-kami">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL akan menjadi: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/') }}/<span id="slug-preview">{{ $page->slug }}</span></code>
                            </p>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-folder text-primary-600 mr-2"></i>
                                Kategori
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="category_id" 
                                    id="category_id" 
                                    required
                                    class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id', $page->category_id) == $category->id ? 'selected' : '' }}>
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
                                Gambar Featured
                            </label>
                            
                            <!-- Current Image -->
                            @if($page->featured_image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                    <div class="relative inline-block">
                                        <img src="{{ Storage::disk('public')->url($page->featured_image) }}" 
                                             alt="{{ $page->title }}" 
                                             class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                        <a href="{{ Storage::disk('public')->url($page->featured_image) }}" 
                                           target="_blank"
                                           class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition duration-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-search-plus text-white text-lg opacity-0 hover:opacity-100 transition duration-200"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- New Image Upload & Preview -->
                            <div id="image-preview" class="mb-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Preview gambar baru:</p>
                                <div class="relative inline-block">
                                    <img id="preview-image" 
                                         src="" 
                                         alt="Preview" 
                                         class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition duration-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-lg opacity-0 hover:opacity-100 transition duration-200"></i>
                                    </div>
                                </div>
                            </div>

                            <input type="file" 
                                   name="featured_image" 
                                   id="featured_image"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"
                                   accept="image/*">
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Format: JPG, PNG, GIF. Maksimal 2MB
                            </p>
                            @error('featured_image')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-file-alt text-primary-600 mr-2"></i>
                                Konten Halaman
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      required 
                                      rows="15"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-4 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 bg-gray-50 focus:bg-white placeholder-gray-400 resize-none"
                                      placeholder="Tulis konten halaman di sini...">{{ old('content', $page->content) }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Gunakan HTML untuk formatting yang lebih baik
                                </p>
                                <span id="content-counter" class="text-xs text-gray-500">{{ strlen($page->content) }} karakter</span>
                            </div>
                            @error('content')
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
                        Update Halaman
                    </button>
                    
                    <a href="{{ route('admin.pages.index') }}" 
                       class="bg-gray-500 text-white px-8 py-4 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                        <i class="fas fa-times mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish Settings Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cog text-primary-600 mr-3"></i>
                    Pengaturan
                </h3>
                
                <div class="space-y-4">
                    <!-- Publish Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div>
                            <p class="font-medium text-gray-800">Status Publikasi</p>
                            <p class="text-sm text-gray-600">Tampilkan halaman di website</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_published" 
                                   value="1" 
                                   class="sr-only peer"
                                   {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                            <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left:0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                    </div>

                    @if($page->published_at)
                    <!-- Published Date -->
                    <div class="p-4 bg-green-50 rounded-xl border border-green-200">
                        <p class="text-sm font-medium text-green-800 mb-1">Dipublikasikan pada:</p>
                        <p class="text-sm text-green-600">
                            <i class="far fa-calendar mr-2"></i>
                            {{ $page->published_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Page Information Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-primary-600 mr-3"></i>
                    Informasi Halaman
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dibuat:</span>
                        <span class="font-semibold text-primary-600">{{ $page->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Diupdate:</span>
                        <span class="font-semibold text-primary-600">{{ $page->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pembuat:</span>
                        <span class="font-semibold text-primary-600">{{ $page->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status:</span>
                        @if($page->is_published)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Draft
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-primary-600 mr-3"></i>
                    Aksi Cepat
                </h3>
                
                <div class="space-y-3">
                    @if($page->is_published)
                        <form action="{{ route('admin.pages.quick-unpublish', $page) }}" method="POST" class="inline-block w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-yellow-500 text-white px-4 py-3 rounded-xl hover:bg-yellow-600 transition duration-200 font-semibold flex items-center justify-center group">
                                <i class="fas fa-eye-slash mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                                Unpublish
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.pages.quick-publish', $page) }}" method="POST" class="inline-block w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-green-500 text-white px-4 py-3 rounded-xl hover:bg-green-600 transition duration-200 font-semibold flex items-center justify-center group">
                                <i class="fas fa-paper-plane mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                                Publikasikan
                            </button>
                        </form>
                    @endif

                    @if($page->is_published)
                        <a href="{{ url('/' . $page->slug) }}" 
                           target="_blank"
                           class="w-full bg-blue-500 text-white px-4 py-3 rounded-xl hover:bg-blue-600 transition duration-200 font-semibold flex items-center justify-center group">
                            <i class="fas fa-external-link-alt mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                            Lihat di Website
                        </a>
                    @endif

                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline-block w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 text-white px-4 py-3 rounded-xl hover:bg-red-600 transition duration-200 font-semibold flex items-center justify-center group"
                                onclick="return confirm('Hapus halaman ini? Tindakan ini tidak dapat dibatalkan.')">
                            <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                            Hapus Halaman
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-blue-600 mr-3"></i>
                    Tips Editing
                </h3>
                
                <ul class="space-y-3 text-sm text-blue-700">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Pastikan slug unik dan SEO-friendly</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Review konten sebelum mempublikasikan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Gunakan gambar yang relevan dan optimal</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Simpan sebagai draft untuk preview</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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

    // Update slug preview when slug input changes
    document.getElementById('slug').addEventListener('input', function() {
        const slug = this.value;
        document.getElementById('slug-preview').textContent = slug;
    });

    // Content character counter
    document.getElementById('content').addEventListener('input', function() {
        const content = this.value;
        const counter = document.getElementById('content-counter');
        
        counter.textContent = content.length + ' karakter';
        
        if (content.length > 10000) {
            counter.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
        }
    });

    // Image preview functionality
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview-image');
        const previewContainer = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Initialize counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.getElementById('content').value;
        document.getElementById('content-counter').textContent = content.length + ' karakter';
    });
</script>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    input[type="checkbox"]:checked ~ .peer-checked\:bg-primary-600 {
        background-color: #3b82f6;
    }

    input[type="checkbox"]:checked ~ .peer-checked\:after\:translate-x-6::after {
        transform: translateX(1.5rem);
    }
</style>
@endsection