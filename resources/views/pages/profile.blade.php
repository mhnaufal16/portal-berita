<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - Perisai Demokrasi Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Perisai Demokrasi Bangsa</h1>
                        <p class="text-sm text-gray-600">Perisai Demokrasi Bangsa</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-amber-600 transition duration-200">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-amber-600 font-semibold border-b-2 border-amber-600 pb-1">Tentang Kami</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition duration-200">
                            <i class="fas fa-tachometer-alt mr-2"></i>Admin Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-amber-600 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                    @endauth
                </nav>

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Dynamic Content -->
    {!! $page->content !!}

    <!-- Call to Action untuk Admin (Jika user login dan mengakses halaman ini) -->
    @auth
    <div class="container mx-auto px-4 mb-12">
        <div class="text-center">
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 inline-block">
                <h4 class="text-lg font-semibold text-amber-800 mb-2">Editor Mode</h4>
                <p class="text-amber-700 mb-4">Anda login sebagai admin. Klik tombol di bawah untuk mengedit halaman ini.</p>
                <a href="{{ route('admin.pages.edit', $page->id) }}" 
                   class="bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 transition duration-200 font-semibold inline-flex items-center">
                    <i class="fas fa-pencil-alt mr-2"></i>Edit Halaman Ini
                </a>
            </div>
        </div>
    </div>
    @endauth

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 border-t-4 border-amber-500">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="text-xl font-bold text-amber-500">Perisai Demokrasi Bangsa</span>
                    </div>
                    <p class="text-gray-400">Menyajikan informasi terkini dan terpercaya untuk masyarakat.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-amber-500">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-500 transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('pages.profile') }}" class="text-gray-400 hover:text-amber-500 transition duration-200">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-amber-500">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2 text-amber-500"></i>info@perisaidemokrasibangsa.com</li>
                        <li><i class="fas fa-phone mr-2 text-amber-500"></i>+62 21 1234 5678</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-amber-500">Follow Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200 text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200 text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200 text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
                <p>&copy; 2025 Perisai Demokrasi Bangsa. mhnaufal16.</p>
            </div>
        </div>
    </footer>
</body>
</html>