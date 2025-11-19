@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-plus-circle mr-3 text-blue-600"></i>Tambah Halaman Baru
    </h2>
    <a href="{{ route('admin.pages.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-200 font-semibold">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<form action="{{ route('admin.pages.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading mr-2 text-blue-600"></i>Judul Halaman
                </label>
                <input type="text" name="title" id="title" required 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Tentang Kami, Visi Misi">
                @error('title')
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-link mr-2 text-blue-600"></i>Slug URL
                </label>
                <input type="text" name="slug" id="slug" required 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    value="{{ old('slug') }}"
                    placeholder="tentang-kami">
                @error('slug')
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt mr-2 text-blue-600"></i>Konten Halaman
                </label>
                <textarea name="content" id="content" required rows="15"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    placeholder="Tulis konten halaman di sini...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Sidebar Settings -->
        <div class="space-y-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="font-semibold text-blue-800 mb-4">
                    <i class="fas fa-cog mr-2"></i>Pengaturan
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                            {{ old('is_published') ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_published" class="ml-2 text-sm font-medium text-gray-700">
                            Publikasikan Halaman
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="font-semibold text-green-800 mb-3">
                    <i class="fas fa-lightbulb mr-2"></i>Tips
                </h3>
                <ul class="text-sm text-green-700 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-green-600"></i>
                        <span>Gunakan slug yang deskriptif</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-2 text-green-600"></i>
                        <span>Pastikan konten informatif</span>
                    </li>
                </ul>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
                <i class="fas fa-save mr-2"></i>Simpan Halaman
            </button>
        </div>
    </div>
</form>

<script>
    // Auto generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection