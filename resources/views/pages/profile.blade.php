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
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-amber-600 transition duration-200">
                        <i class="fas fa-home mr-2 text-amber-500"></i>Beranda
                    </a>
                    <a href="{{ route('pages.profile') }}" class="flex items-center text-amber-600 font-semibold border-b-2 border-amber-600 pb-1">
                        <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition duration-200 flex items-center">
                            <i class="fas fa-tachometer-alt mr-2"></i>Admin Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center text-gray-600 hover:text-amber-600 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2 text-amber-500"></i>Login
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
    <section class="bg-gradient-to-r from-gray-900 via-gray-800 to-amber-900 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">{{ $page->title }}</h2>
            <p class="text-xl mb-8 opacity-90">Mengenal lebih dekat Perisai Demokrasi Bangsa</p>
            <div class="flex items-center justify-center space-x-6 text-sm opacity-80">
                <span class="flex items-center">
                    <i class="far fa-user mr-2"></i>Admin
                </span>
                <span class="flex items-center">
                    <i class="far fa-calendar mr-2"></i>{{ $page->created_at->format('d M Y') }}
                </span>
                <span class="flex items-center">
                    <i class="far fa-eye mr-2"></i>{{ rand(500, 2000) }} dibaca
                </span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Content Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-8">
                <div class="p-8 md:p-12">
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            <!-- Share & Edit Section -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 p-6">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 font-semibold">Bagikan:</span>
                        <div class="flex space-x-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($page->title) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($page->title . ' ' . url()->current()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    
                    @auth
                    <a href="{{ route('admin.pages.edit', $page->id) }}" 
                       class="bg-amber-500 text-white px-6 py-3 rounded-lg hover:bg-amber-600 transition duration-200 font-semibold flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-pencil-alt mr-2"></i>Edit Halaman
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </main>

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
                        <li><i class="fas fa-phone mr-2 text-amber-500"></i>+62 123 4567 890</li>
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

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .prose {
            line-height: 1.8;
        }
        .prose p {
            margin-bottom: 1.5em;
        }
        .prose h2 {
            font-size: 1.875em;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 1em;
            color: #1f2937;
            border-left: 4px solid #f59e0b;
            padding-left: 1rem;
        }
        .prose h3 {
            font-size: 1.5em;
            font-weight: 600;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            color: #374151;
        }
        .prose ul, .prose ol {
            margin-top: 1em;
            margin-bottom: 1em;
            padding-left: 1.5em;
        }
        .prose li {
            margin-bottom: 0.5em;
        }
        .prose strong {
            color: #f59e0b;
        }
    </style>
</body>
</html>