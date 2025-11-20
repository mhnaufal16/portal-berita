<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Portal Berita</title>
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
            <p class="text-xl mb-8 opacity-90">{{ $profileData['tagline'] }}</p>
            @auth
            <a href="{{ route('admin.pages.index') }}" 
               class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200 inline-flex items-center">
                <i class="fas fa-cog mr-2"></i>Kelola Halaman Profile
            </a>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Company Overview -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $profileData['nama_perusahaan'] }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $profileData['deskripsi'] }}</p>
            </div>

            <!-- Company Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center p-6 bg-blue-50 rounded-lg">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $profileData['tahun_berdiri'] }}</h3>
                    <p class="text-gray-600">Tahun Berdiri</p>
                </div>
                
                <div class="text-center p-6 bg-green-50 rounded-lg">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $profileData['jumlah_karyawan'] }}</h3>
                    <p class="text-gray-600">Professional Team</p>
                </div>
                
                <div class="text-center p-6 bg-purple-50 rounded-lg">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">10,000+</h3>
                    <p class="text-gray-600">Berita Dipublikasikan</p>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Visi -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Visi Perusahaan</h3>
                    </div>
                    <p class="text-lg leading-relaxed">{{ $profileData['visi'] }}</p>
                </div>

                <!-- Misi -->
                <div class="bg-white border border-gray-200 p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Misi Perusahaan</h3>
                    </div>
                    <ul class="space-y-4">
                        @foreach($profileData['misi'] as $misi)
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">{{ $misi }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Nilai Perusahaan -->
            <div class="mb-12">
                <h3 class="text-3xl font-bold text-gray-800 text-center mb-8">Nilai Perusahaan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($profileData['nilai_perusahaan'] as $nilai => $deskripsi)
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $nilai }}</h4>
                        <p class="text-gray-600">{{ $deskripsi }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-50 rounded-xl p-8">
                <h3 class="text-3xl font-bold text-gray-800 text-center mb-8">Informasi Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600">{{ $profileData['alamat'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 text-xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Telepon</h4>
                                <p class="text-gray-600">{{ $profileData['telepon'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 text-xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">{{ $profileData['email'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-600 text-xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action untuk Admin -->
            @auth
            <div class="mt-8 text-center">
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <h4 class="text-lg font-semibold text-yellow-800 mb-2">Ingin Mengubah Konten Ini?</h4>
                    <p class="text-yellow-700 mb-4">Kelola halaman profile perusahaan melalui admin panel untuk mengedit konten dengan mudah.</p>
                    <a href="{{ route('admin.pages.index') }}" 
                       class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition duration-200 font-semibold inline-flex items-center">
                        <i class="fas fa-cog mr-2"></i>Kelola Halaman Profile
                    </a>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
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
                        <li><i class="fas fa-envelope mr-2"></i>{{ $profileData['email'] }}</li>
                        <li><i class="fas fa-phone mr-2"></i>{{ $profileData['telepon'] }}</li>
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