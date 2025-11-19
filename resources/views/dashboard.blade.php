<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-lg">{{ __("You're logged in!") }}</p>
                    
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">Selamat datang di Portal Berita!</h3>
                        <p class="text-gray-600">Anda telah berhasil login. Gunakan Admin Panel untuk mengelola konten website.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 text-center block">
                            🚀 Buka Admin Panel
                        </a>
                        <a href="{{ route('home') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 text-center block">
                            🏠 Kembali ke Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>