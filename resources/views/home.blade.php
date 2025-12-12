<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perisai Demokrasi Bangsa - Informasi Terkini dan Terpercaya</title>
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
                    <a href="{{ route('home') }}" class="text-amber-600 font-semibold border-b-2 border-amber-600 pb-1">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-gray-600 hover:text-amber-600 transition duration-200">Tentang Kami</a>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-gray-900 via-gray-800 to-amber-900 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Perisai Demokrasi Bangsa</h2>
            <p class="text-xl mb-8 opacity-90">Dapatkan informasi terkini dan terpercaya dari berbagai kategori</p>
            <a href="#berita-terbaru" class="bg-amber-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-600 transition duration-200 shadow-lg border border-amber-400">
                <i class="fas fa-newspaper mr-2"></i>Lihat Berita Terbaru
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12" id="berita-terbaru">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 border-l-4 border-amber-500 pl-4">
                Berita Terbaru
            </h2>
            <div class="flex items-center space-x-2 text-gray-600">
                <i class="fas fa-rss text-amber-500"></i>
                <span>Update Real-time</span>
            </div>
        </div>
        
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100">
                    @if($post->featured_image)
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                        <i class="fas fa-newspaper text-amber-500 text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $post->category->name }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-amber-600 transition">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-user mr-1"></i>{{ $post->user->name }}
                            </span>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-amber-600 hover:text-amber-800 font-semibold text-sm flex items-center">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-500 mb-6">Saat ini belum ada berita yang dipublikasikan.</p>
                @auth
                <a href="{{ route('admin.posts.create') }}" class="bg-amber-500 text-white px-6 py-3 rounded-lg hover:bg-amber-600 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Buat Berita Pertama
                </a>
                @endif
            </div>
        @endif
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
                        <li><i class="fas fa-envelope mr-2 text-amber-500"></i>info@Perisai Demokrasi Bangsa.com</li>
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
    </style>
</body>
</html>