<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuButton" class="bg-primary-600 text-white p-3 rounded-lg shadow-lg">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 fixed lg:relative h-full z-40">
            <!-- Logo -->
            <div class="p-6 border-b border-primary-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-newspaper text-primary-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">PortalBerita</h1>
                        <p class="text-primary-200 text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-primary-700">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-primary-200 text-sm truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700 shadow-lg transform scale-105' : 'hover:bg-primary-700 hover:shadow-md' }}">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-primary-700 shadow-lg transform scale-105' : 'hover:bg-primary-700 hover:shadow-md' }}">
                    <i class="fas fa-newspaper w-6 text-center"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-primary-700 shadow-lg transform scale-105' : 'hover:bg-primary-700 hover:shadow-md' }}">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pages.*') ? 'bg-primary-700 shadow-lg transform scale-105' : 'hover:bg-primary-700 hover:shadow-md' }}">
                    <i class="fas fa-file-alt w-6 text-center"></i>
                    <span>Halaman</span>
                </a>

                <div class="pt-4 border-t border-primary-700">
                    <a href="{{ route('home') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-primary-700 hover:shadow-md">
                        <i class="fas fa-globe w-6 text-center"></i>
                        <span>Lihat Website</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 hover:bg-red-600 hover:shadow-md text-left">
                            <i class="fas fa-sign-out-alt w-6 text-center"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-primary-700">
                <div class="text-center text-primary-300 text-sm">
                    <p>PortalBerita v1.0</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0 min-h-screen">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 lg:static fixed top-0 left-0 right-0 z-30">
                <div class="flex justify-between items-center px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-xl font-semibold text-gray-800 hidden lg:block">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <div class="text-sm text-gray-500 hidden md:block">
                            <i class="far fa-calendar mr-2"></i>
                            <span id="currentDateTime"></span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-primary-600 transition duration-200">
                            <i class="far fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>

                        <!-- Quick Actions -->
                        <div class="hidden md:flex items-center space-x-2">
                            <a href="{{ route('admin.posts.create') }}" 
                               class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-200 font-semibold text-sm">
                                <i class="fas fa-plus mr-2"></i>Buat Baru
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto mt-16 lg:mt-0 p-6">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm text-gray-600">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600 transition duration-200">Dashboard</a></li>
                        @hasSection('breadcrumb')
                            <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                            <li>@yield('breadcrumb')</li>
                        @endif
                    </ol>
                </nav>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center shadow-sm">
                        <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-green-800 font-semibold">Sukses!</p>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-red-800 font-semibold">Error!</p>
                            <p class="text-red-700 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 min-h-[calc(100vh-200px)]">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function toggleMobileMenu() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        }

        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        mobileOverlay.addEventListener('click', toggleMobileMenu);

        // Close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.add('hidden');
            }
        });

        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('id-ID', options);
        }

        updateDateTime();
        setInterval(updateDateTime, 60000); // Update every minute

        // Add smooth transitions to all interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            const interactiveElements = document.querySelectorAll('a, button, input, select, textarea');
            interactiveElements.forEach(element => {
                element.classList.add('transition-colors', 'duration-200');
            });
        });
    </script>

    <style>
        /* Custom scrollbar for sidebar */
        #sidebar::-webkit-scrollbar {
            width: 4px;
        }
        
        #sidebar::-webkit-scrollbar-track {
            background: #1e3a8a;
        }
        
        #sidebar::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</body>
</html>