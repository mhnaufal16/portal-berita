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
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">P</span>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 hover:text-blue-600 transition duration-200">Perisai Demokrasi Bangsa</a>
                        <p class="text-xs text-gray-500">Informasi terkini dan terpercaya</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition duration-200 text-sm">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-blue-600 font-semibold text-sm">Tentang Kami</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 text-sm flex items-center">
                            <i class="fas fa-user-shield mr-2"></i>Admin Panel
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

    <!-- Breadcrumb -->
    <nav class="bg-gray-50 border-b border-gray-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 transition duration-200 flex items-center">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-700 font-medium">{{ $page->title }}</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header -->
            <div class="text-center mb-8">
                <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-medium mb-4">
                    Artikel
                </span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
                
                <div class="flex items-center justify-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <i class="far fa-user mr-1"></i>
                        Admin
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-clock mr-1"></i>
                        {{ $page->created_at->format('d M Y') }}
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-eye mr-1"></i>
                        {{ rand(300, 800) }} dibaca
                    </span>
                </div>
            </div>

            <!-- Page Content -->
            <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $page->content !!}
                </div>
            </div>

            <!-- Share Section -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-700 font-medium">Bagikan:</span>
                        <div class="flex space-x-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank"
                               class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition duration-200"
                               title="Share to Facebook">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($page->title) }}" 
                               target="_blank"
                               class="w-9 h-9 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition duration-200"
                               title="Share to Twitter">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($page->title . ' ' . url()->current()) }}" 
                               target="_blank"
                               class="w-9 h-9 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition duration-200"
                               title="Share to WhatsApp">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                    
                    @auth
                    <div>
                        <a href="{{ route('admin.pages.edit', $page->id) }}" 
                           class="inline-flex items-center bg-amber-600 text-white px-4 py-2 rounded-md hover:bg-amber-700 transition duration-200 text-sm font-medium">
                            <i class="fas fa-pencil-alt mr-2"></i>Edit Halaman
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </main>

    <!-- Berita Lainnya Section -->
    <section class="bg-gray-100 py-12 mt-8">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center justify-center">
                <i class="fas fa-newspaper mr-3 text-blue-600"></i>
                Berita Lainnya
            </h2>
            
            @php
                $latestPosts = \App\Models\Post::where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp
            
            @if($latestPosts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach($latestPosts as $post)
                <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                    @if($post->featured_image)
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-5">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium mb-3 inline-block">
                            {{ $post->category->name }}
                        </span>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $post->excerpt }}</p>
                        
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600">Belum ada berita lainnya.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">P</span>
                        </div>
                        <span class="text-lg font-bold">Perisai Demokrasi Bangsa</span>
                    </div>
                    <p class="text-gray-400 text-sm">Menyajikan informasi terkini dan terpercaya untuk masyarakat.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('pages.profile') }}" class="text-gray-400 hover:text-white transition duration-200">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>
                            info@perisaidemokrasibangsa.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-blue-500"></i>
                            +62 123 4567 890
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm">Follow Kami</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-sky-500 rounded-full flex items-center justify-center hover:bg-sky-600 transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
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
        .prose {
            line-height: 1.75;
        }
        .prose p {
            margin-bottom: 1.25em;
        }
        .prose h2 {
            font-size: 1.75em;
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            color: #1f2937;
        }
        .prose h3 {
            font-size: 1.5em;
            font-weight: 600;
            margin-top: 1.25em;
            margin-bottom: 0.5em;
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
    </style>
</body>
</html>