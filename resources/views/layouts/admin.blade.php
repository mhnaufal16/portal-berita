<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portal Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 h-screen bg-blue-800 text-white fixed">
            <div class="p-4">
                <h1 class="text-xl font-bold">Portal Berita Admin</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 hover:bg-blue-700 {{ request()->routeIs('admin.posts.*') ? 'bg-blue-700' : '' }}">
                    Berita
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-blue-700 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-700' : '' }}">
                    Kategori
                </a>
                <a href="{{ route('admin.pages.index') }}" class="block py-2 px-4 hover:bg-blue-700 {{ request()->routeIs('admin.pages.*') ? 'bg-blue-700' : '' }}">
                    Halaman
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-blue-700">
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 flex-1 p-6">
            <div class="bg-white rounded-lg shadow p-6">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>