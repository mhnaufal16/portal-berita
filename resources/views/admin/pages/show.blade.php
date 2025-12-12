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
    <!-- Header -->
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
                <div class="flex items-center justify-between mb-6">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $page->category->name ?? 'Halaman' }}
                    </span>
                    <span class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>{{ $page->updated_at->translatedFormat('d F Y') }}
                    </span>
                </div>
                
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-white"></i>
                        </div>
                        <span class="text-xl font-bold">Perisai Demokrasi Bangsa</span>
                    </div>
                    <p class="text-gray-400">Menyajikan informasi terkini dan terpercaya untuk masyarakat.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('pages.profile') }}" class="text-gray-400 hover:text-white transition duration-200">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>info@Perisai Demokrasi Bangsa.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 21 1234 5678</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Perisai Demokrasi Bangsa. mhnaufal16.</p>
            </div>
        </div>
    </footer>
</body>
</html>