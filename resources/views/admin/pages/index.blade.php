@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        <i class="fas fa-file-alt mr-3 text-blue-600"></i>Manajemen Halaman
    </h2>
    <a href="{{ route('admin.pages.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
        <i class="fas fa-plus mr-2"></i>Tambah Halaman
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 flex items-center">
        <i class="fas fa-check-circle mr-3 text-green-600"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <i class="fas fa-heading mr-2"></i>Judul
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <i class="fas fa-link mr-2"></i>Slug
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <i class="fas fa-toggle-on mr-2"></i>Status
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <i class="fas fa-calendar mr-2"></i>Dibuat
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <i class="fas fa-cog mr-2"></i>Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pages as $page)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $page->title }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $page->slug }}</code>
                    </td>
                    <td class="px-6 py-4">
                        @if($page->is_published)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $page->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.pages.edit', $page) }}" 
                               class="text-blue-600 hover:text-blue-900 transition duration-200"
                               title="Edit Halaman">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 transition duration-200"
                                        onclick="return confirm('Hapus halaman ini?')"
                                        title="Hapus Halaman">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4"></i>
                            <p class="text-lg font-medium">Belum ada halaman</p>
                            <p class="text-sm mt-2">Mulai dengan membuat halaman pertama Anda</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pages->hasPages())
<div class="mt-6">
    {{ $pages->links() }}
</div>
@endif
@endsection