<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Perisai Demokrasi Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                            950: '#451a03',
                        },
                        dark: {
                            bg: '#161615',
                            card: '#1b1b18',
                            border: '#3E3E3A',
                            text: '#EDEDEC',
                            muted: '#A1A09A'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] font-sans text-[#1b1b18]">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuButton" class="bg-dark-card text-white p-3 rounded-lg shadow-lg border border-dark-border">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-[#161615] text-[#EDEDEC] border-r border-[#3E3E3A] transform -translate-x-full lg:translate-x-0 transition-transform duration-300 fixed lg:relative h-full z-40">
            <!-- Logo -->
            <div class="p-6 border-b border-[#3E3E3A]">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('img/logo.png') }}" class="w-8 h-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Perisai Demokrasi</h1>
                        <p class="text-[#A1A09A] text-xs">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-[#3E3E3A]">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-[#1b1b18] border border-[#3E3E3A] rounded-full flex items-center justify-center shadow">
                        <i class="fas fa-user text-[#EDEDEC]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold truncate text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-[#A1A09A] text-xs truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-500 text-white shadow-lg' : 'text-[#EDEDEC] hover:bg-[#3E3E3A] hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-primary-500 text-white shadow-lg' : 'text-[#EDEDEC] hover:bg-[#3E3E3A] hover:text-white' }}">
                    <i class="fas fa-newspaper w-6 text-center"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-primary-500 text-white shadow-lg' : 'text-[#EDEDEC] hover:bg-[#3E3E3A] hover:text-white' }}">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('admin.pages.index') }}" 
                   class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pages.*') ? 'bg-primary-500 text-white shadow-lg' : 'text-[#EDEDEC] hover:bg-[#3E3E3A] hover:text-white' }}">
                    <i class="fas fa-file-alt w-6 text-center"></i>
                    <span>Halaman</span>
                </a>

                <div class="pt-4 border-t border-[#3E3E3A] mt-4">
                    <a href="{{ route('home') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-[#EDEDEC] hover:bg-[#3E3E3A] hover:text-white">
                        <i class="fas fa-globe w-6 text-center"></i>
                        <span>Lihat Website</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-red-400 hover:bg-red-500/10 hover:text-red-500 text-left">
                            <i class="fas fa-sign-out-alt w-6 text-center"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-[#3E3E3A]">
                <div class="text-center text-[#A1A09A] text-xs">
                    <p>Perisai Demokrasi Bangsa v1.0</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0 min-h-screen bg-[#FDFDFC]">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-sm shadow-sm border-b border-[#e3e3e0] sticky top-0 z-30">
                <div class="flex justify-between items-center px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-xl font-semibold text-[#1b1b18] hidden lg:block tracking-tight">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <div class="text-sm text-[#706f6c] hidden md:block border-l border-[#e3e3e0] pl-4">
                            <i class="far fa-calendar mr-2"></i>
                            <span id="currentDateTime"></span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-[#706f6c] hover:text-primary-600 transition duration-200">
                            <i class="far fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">3</span>
                        </button>

                        <!-- Quick Actions -->
                        <div class="hidden md:flex items-center space-x-2">
                            <a href="{{ route('admin.posts.create') }}" 
                               class="bg-[#1b1b18] text-white px-4 py-2 rounded-lg hover:bg-black transition duration-200 font-medium text-sm flex items-center shadow-lg shadow-black/5">
                                <i class="fas fa-plus mr-2 text-primary-500"></i>Buat Baru
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto p-6 lg:p-8">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm text-[#706f6c]">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600 transition duration-200">Dashboard</a></li>
                        @hasSection('breadcrumb')
                            <li><i class="fas fa-chevron-right text-[#e3e3e0] text-xs"></i></li>
                            <li class="font-medium text-[#1b1b18]">@yield('breadcrumb')</li>
                        @endif
                    </ol>
                </nav>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 mb-6 flex items-center shadow-sm">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-semibold">Sukses!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 mb-6 flex items-center shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-semibold">Error!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Page Content Wrapper -->
                <div class="animate-fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 lg:hidden hidden"></div>

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
            background: #161615;
        }
        
        #sidebar::-webkit-scrollbar-thumb {
            background: #3E3E3A;
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #575752;
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
            animation: fadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #1b1b18 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</body>
</html>