<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - Portal Berita</title>
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
                        <h1 class="text-2xl font-bold text-gray-800">PortalBerita</h1>
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

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Tentang PortalBerita</h2>
            <p class="text-xl mb-8 opacity-90">Informasi Terkini dan Terpercaya</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Admin Edit Button -->
            @auth
            <div class="flex justify-end mb-6">
                <a href="{{ route('admin.pages.edit', $page) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Halaman
                </a>
            </div>
            @endauth

            <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">{{ $page->title }}</h1>
            
            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                {!! $page->content !!}
            </div>
            
            <!-- Additional Stats Section -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-blue-50 rounded-xl">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sejak 2018</h3>
                    <p class="text-gray-600">Melayani dengan dedikasi</p>
                </div>
                
                <div class="text-center p-6 bg-green-50 rounded-xl">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">150+ Team</h3>
                    <p class="text-gray-600">Profesional berpengalaman</p>
                </div>
                
                <div class="text-center p-6 bg-purple-50 rounded-xl">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">10,000+</h3>
                    <p class="text-gray-600">Berita terpublikasi</p>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
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
                        <span class="text-xl font-bold">PortalBerita</span>
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
                        <li><i class="fas fa-envelope mr-2"></i>info@portalberita.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 21 1234 5678</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Follow Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 PortalBerita. mhnaufal16.</p>
            </div>
        </div>
    </footer>
</body>
</html>