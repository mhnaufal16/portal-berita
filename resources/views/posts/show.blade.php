<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Portal Berita</title>
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
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition duration-200">PortalBerita</a>
                        <p class="text-sm text-gray-600">Informasi Terkini dan Terpercaya</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">Tentang Kami</a>
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

    <!-- Breadcrumb -->
    <nav class="bg-blue-50 border-b border-blue-100">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center space-x-2 text-sm text-blue-700">
                <a href="{{ route('home') }}" class="hover:text-blue-900 transition duration-200">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>
                <i class="fas fa-chevron-right text-blue-400"></i>
                <a href="{{ route('home') }}#berita-terbaru" class="hover:text-blue-900 transition duration-200">Berita</a>
                <i class="fas fa-chevron-right text-blue-400"></i>
                <span class="text-blue-900 font-medium">{{ $post->category->name }}</span>
                <i class="fas fa-chevron-right text-blue-400"></i>
                <span class="text-gray-600 truncate">{{ Str::limit($post->title, 50) }}</span>
            </div>
        </div>
    </nav>

    <!-- Article Content -->
    <main class="container mx-auto px-4 py-8">
        <article class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-8 text-center">
                <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    {{ $post->category->name }}
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">{{ $post->title }}</h1>
                
                <div class="flex flex-wrap justify-center items-center gap-4 text-gray-600 mb-6">
                    <div class="flex items-center">
                        <i class="far fa-user mr-2"></i>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-eye mr-2"></i>
                        <span>{{ rand(100, 1000) }} dibaca</span>
                    </div>
                </div>

                @if($post->featured_image)
                <div class="rounded-2xl overflow-hidden shadow-lg mb-6">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
                </div>
                @endif
            </header>

            <!-- Article Excerpt -->
            @if($post->excerpt)
            <div class="bg-blue-50 border-l-4 border-blue-600 p-6 mb-8 rounded-r-lg">
                <p class="text-lg text-gray-700 italic">"{{ $post->excerpt }}"</p>
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-12">
                <div class="text-gray-700 leading-relaxed text-justify">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="border-t border-gray-200 pt-8">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Bagikan:</span>
                        <div class="flex space-x-2">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition duration-200">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-white hover:bg-blue-500 transition duration-200">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition duration-200">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-gray-600">
                        <i class="fas fa-tags"></i>
                        <span class="font-medium">Kategori:</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">{{ $post->category->name }}</span>
                    </div>
                </div>
            </footer>
        </article>
    </main>

    <!-- Related Posts Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                <i class="fas fa-newspaper mr-3 text-blue-600"></i>Berita Lainnya
            </h2>
            
            @php
                $relatedPosts = \App\Models\Post::where('category_id', $post->category_id)
                    ->where('id', '!=', $post->id)
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp
            
            @if($relatedPosts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    @if($relatedPost->featured_image)
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold mb-3 inline-block">
                            {{ $relatedPost->category->name }}
                        </span>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $relatedPost->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $relatedPost->excerpt }}</p>
                        
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm inline-flex items-center">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600">Belum ada berita lainnya dalam kategori ini.</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-newspaper mr-2"></i>Lihat Semua Berita
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer (sama seperti homepage) -->
    <footer class="bg-gray-800 text-white py-12">
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
                        <li><i class="fas fa-phone mr-2"></i>+62 123 4567 890</li>
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
            line-height: 1.75;
        }
        .prose p {
            margin-bottom: 1.5em;
        }
    </style>
</body>
</html>