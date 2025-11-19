@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Tambah Berita Baru</h2>
    <a href="{{ route('admin.posts.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Kembali
    </a>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" name="title" id="title" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    value="{{ old('slug') }}">
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700">Gambar Utama</label>
                <input type="file" name="featured_image" id="featured_image" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    accept="image/*">
                @error('featured_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan</label>
            <textarea name="excerpt" id="excerpt" required rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('excerpt') }}</textarea>
            @error('excerpt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
            <textarea name="content" id="content" required rows="10"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_published" value="1" 
                    {{ old('is_published') ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 shadow-sm">
                <span class="ml-2 text-sm text-gray-600">Publikasikan berita ini</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Simpan Berita
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