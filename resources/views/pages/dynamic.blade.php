<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - Perisai Demokrasi Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header (sama seperti di profile.blade.php) -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Perisai Demokrasi Bangsa</h1>
                        <p class="text-sm text-gray-600">Informasi Terkini dan Terpercaya</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">Tentang Kami</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-tachometer-alt mr-2"></i>Admin Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if($page->featured_image)
            <div class="h-64 bg-gray-200 overflow-hidden">
                <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $page->title }}</h1>
                
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $page->content !!}
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </article>
    </main>

    <!-- Footer (sama seperti di profile.blade.php) -->
    <footer class="bg-gray-800 text-white py-12 mt-12">
        <div class="container mx-auto px-4">
            <!-- Footer content sama seperti di profile.blade.php -->
        </div>
    </footer>
</body>
</html>