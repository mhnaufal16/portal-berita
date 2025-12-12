<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Perisai Demokrasi Bangsa</title>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-gray-900 via-gray-800 to-amber-900 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Tentang Perisai Demokrasi Bangsa</h2>
            <p class="text-xl mb-8 opacity-90">{{ $profileData['tagline'] }}</p>

        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Company Overview -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12 border border-gray-100">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $profileData['nama_perusahaan'] }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $profileData['deskripsi'] }}</p>
            </div>

            <!-- Company Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center p-6 bg-amber-50 rounded-lg border border-amber-100">
                    <div class="w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $profileData['tahun_berdiri'] }}</h3>
                    <p class="text-gray-600">Tahun Berdiri</p>
                </div>
                
                <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $profileData['jumlah_karyawan'] }}</h3>
                    <p class="text-gray-600">Professional Team</p>
                </div>
                
                <div class="text-center p-6 bg-amber-50 rounded-lg border border-amber-100">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-newspaper text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">10,000+</h3>
                    <p class="text-gray-600">Berita Dipublikasikan</p>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Visi -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 text-white p-8 rounded-xl shadow-xl border-l-4 border-amber-500">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-white bg-opacity-10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-2xl text-amber-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-400">Visi Perusahaan</h3>
                    </div>
                    <p class="text-lg leading-relaxed text-gray-300">{{ $profileData['visi'] }}</p>
                </div>

                <!-- Misi -->
                <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-amber-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Misi Perusahaan</h3>
                    </div>
                    <ul class="space-y-4">
                        @foreach($profileData['misi'] as $misi)
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
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
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                        <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $nilai }}</h4>
                        <p class="text-gray-600">{{ $deskripsi }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-50 rounded-xl p-8 border border-gray-200">
                <h3 class="text-3xl font-bold text-gray-800 text-center mb-8">Informasi Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm mr-4">
                                <i class="fas fa-map-marker-alt text-amber-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600">{{ $profileData['alamat'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm mr-4">
                                <i class="fas fa-phone text-amber-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Telepon</h4>
                                <p class="text-gray-600">{{ $profileData['telepon'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm mr-4">
                                <i class="fas fa-envelope text-amber-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">{{ $profileData['email'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm mr-4">
                                <i class="fas fa-clock text-amber-600 text-xl"></i>
                            </div>
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
            @endif
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
                        <li><i class="fas fa-envelope mr-2 text-amber-500"></i>{{ $profileData['email'] }}</li>
                        <li><i class="fas fa-phone mr-2 text-amber-500"></i>{{ $profileData['telepon'] }}</li>
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