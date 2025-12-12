@extends('layouts.admin')

@section('page-title', 'Tambah Halaman Baru')
@section('breadcrumb', 'Buat Halaman')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-plus-circle text-primary-600 mr-3"></i>
                Tambah Halaman Baru
            </h1>
            <p class="text-gray-600 mt-2">Buat halaman statis baru untuk website Anda</p>
        </div>
        
        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
            <a href="{{ route('admin.pages.index') }}" 
               class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
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
                                   value="{{ old('title') }}"
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
                                   value="{{ old('slug') }}"
                                   placeholder="tentang-kami">
                            @error('slug')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                URL akan menjadi: <code class="bg-gray-100 px-2 py-1 rounded ml-1">{{ url('/') }}/<span id="slug-preview">slug-halaman</span></code>
                            </p>
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
                                      placeholder="Tulis konten halaman di sini...">{{ old('content') }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Gunakan HTML untuk formatting yang lebih baik
                                </p>
                                <span id="content-counter" class="text-xs text-gray-500">0 karakter</span>
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
                            name="action" 
                            value="publish"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold flex items-center group">
                        <i class="fas fa-paper-plane mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Simpan & Publikasikan
                    </button>
                    
                    <button type="submit" 
                            name="action" 
                            value="draft"
                            class="bg-gray-500 text-white px-8 py-4 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow font-semibold flex items-center group">
                        <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                        Simpan sebagai Draft
                    </button>
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
                                   {{ old('is_published') ? 'checked' : '' }}>
                            <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left:0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        </label>
                    </div>

                    <!-- Quick Stats -->
                    <div class="pt-4 border-t border-gray-200">
                        <h4 class="font-medium text-gray-800 mb-3">Statistik</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Halaman:</span>
                                <span class="font-semibold text-primary-600">{{ \App\Models\Page::count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Published:</span>
                                <span class="font-semibold text-green-600">{{ \App\Models\Page::where('is_published', true)->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Draft:</span>
                                <span class="font-semibold text-yellow-600">{{ \App\Models\Page::where('is_published', false)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-blue-600 mr-3"></i>
                    Tips Konten Halaman
                </h3>
                
                <ul class="space-y-3 text-sm text-blue-700">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Gunakan judul yang jelas dan deskriptif</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Slug harus SEO-friendly dan mudah diingat</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Gunakan gambar yang relevan dan optimal</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3 text-blue-600 flex-shrink-0"></i>
                        <span>Konten yang informatif dan terstruktur</span>
                    </li>
                </ul>
            </div>

            <!-- Content Preview Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-eye text-primary-600 mr-3"></i>
                    Preview Konten
                </h3>
                
                <div class="space-y-2 text-sm">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Judul:</span>
                        <p id="preview-title" class="font-semibold text-primary-600 mt-1">-</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Slug:</span>
                        <p id="preview-slug" class="font-mono text-primary-600 mt-1">-</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Konten:</span>
                        <p id="preview-content" class="text-gray-800 mt-1 line-clamp-3">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        content_style: 'body { font-family:Instrument Sans,sans-serif; font-size:16px }',
        setup: function (editor) {
            editor.on('input change', function () {
                const content = editor.getContent();
                const counter = document.getElementById('content-counter');
                
                counter.textContent = content.length + ' karakter';
                
                if (content.length > 50000) {
                    counter.classList.add('text-red-500');
                } else {
                    counter.classList.remove('text-red-500');
                }
            });
        }
    });

    // Auto generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
        document.getElementById('slug-preview').textContent = slug;
        
        // Update preview
        document.getElementById('preview-title').textContent = title || '-';
        document.getElementById('preview-slug').textContent = slug || '-';
    });

    // Update slug preview when slug input changes
    document.getElementById('slug').addEventListener('input', function() {
        const slug = this.value;
        document.getElementById('slug-preview').textContent = slug;
        document.getElementById('preview-slug').textContent = slug || '-';
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