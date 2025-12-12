<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Perisai Demokrasi Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 hover:text-amber-600 transition duration-200">Perisai Demokrasi Bangsa</a>
                        <p class="text-xs text-gray-600">Perisai Demokrasi Bangsa</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 transition duration-200 text-sm font-medium">Beranda</a>
                    <a href="{{ route('pages.profile') }}" class="text-gray-700 hover:text-amber-600 transition duration-200 text-sm font-medium">Tentang Kami</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition duration-200 text-sm font-medium flex items-center">
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
    <nav class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-amber-600 hover:text-amber-700 transition duration-200 flex items-center">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="{{ route('home') }}#berita-terbaru" class="text-amber-600 hover:text-amber-700 transition duration-200">Berita</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-700 font-medium">{{ $post->category->name }}</span>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-500 truncate max-w-xs">{{ Str::limit($post->title, 30) }}</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <div class="text-center mb-8">
                <span class="inline-block bg-amber-100 text-amber-700 px-4 py-1 rounded-full text-sm font-medium mb-4">
                    {{ $post->category->name }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $post->title }}</h1>
                
                <div class="flex items-center justify-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <i class="far fa-user mr-1"></i>
                        {{ $post->user->name }}
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-clock mr-1"></i>
                        {{ $post->created_at->format('d M Y') }}
                    </span>
                    <span class="flex items-center">
                        <i class="far fa-eye mr-1"></i>
                        {{ rand(100, 1000) }} dibaca
                    </span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
            <div class="rounded-lg overflow-hidden shadow-md mb-8">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
            </div>
            @endif

            <!-- Article Excerpt -->
            @if($post->excerpt)
            <div class="bg-amber-50 border-l-4 border-amber-500 p-5 mb-8 rounded-r">
                <p class="text-gray-700 italic text-base">"{{ $post->excerpt }}"</p>
            </div>
            @endif

            <!-- Article Content -->
            <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Share & Category Section -->
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
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" 
                               target="_blank"
                               class="w-9 h-9 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition duration-200"
                               title="Share to Twitter">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
                               target="_blank"
                               class="w-9 h-9 bg-green-500 rounded-full flex items-center justify-center text-white hover:bg-green-600 transition duration-200"
                               title="Share to WhatsApp">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-gray-600">
                        <i class="fas fa-tags"></i>
                        <span class="font-medium text-sm">Kategori:</span>
                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-medium">{{ $post->category->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Berita Lainnya Section -->
    <section class="bg-gray-100 py-12 mt-8">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center justify-center">
                <i class="fas fa-newspaper mr-3 text-amber-600"></i>
                Berita Lainnya
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach($relatedPosts as $relatedPost)
                <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                    @if($relatedPost->featured_image)
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                        <i class="fas fa-newspaper text-amber-500 text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-5">
                        <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-medium mb-3 inline-block">
                            {{ $relatedPost->category->name }}
                        </span>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $relatedPost->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $relatedPost->excerpt }}</p>
                        
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-amber-600 hover:text-amber-700 font-medium text-sm inline-flex items-center">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600">Belum ada berita lainnya dalam kategori ini.</p>
                <a href="{{ route('home') }}" class="inline-block mt-4 bg-amber-500 text-white px-6 py-3 rounded-lg hover:bg-amber-600 transition duration-200 text-sm font-medium">
                    <i class="fas fa-newspaper mr-2"></i>Lihat Semua Berita
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain brightness-0 invert">
                        </div>
                        <span class="text-lg font-bold">Perisai Demokrasi Bangsa</span>
                    </div>
                    <p class="text-gray-400 text-sm">Menyajikan informasi terkini dan terpercaya untuk masyarakat.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm text-amber-500">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-500 transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('pages.profile') }}" class="text-gray-400 hover:text-amber-500 transition duration-200">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm text-amber-500">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-amber-500"></i>
                            info@perisaidemokrasibangsa.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-amber-500"></i>
                            +62 123 4567 890
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-sm text-amber-500">Follow Kami</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition duration-200">
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
    </style>
</body>
</html>