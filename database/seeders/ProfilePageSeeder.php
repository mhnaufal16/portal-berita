<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class ProfilePageSeeder extends Seeder
{
    public function run()
    {
        $content = <<<'HTML'
<!-- Hero Section -->
<section class="bg-gradient-to-r from-gray-900 via-gray-800 to-amber-900 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">Tentang Perisai Demokrasi Bangsa</h2>
        <p class="text-xl mb-8 opacity-90">Informasi Terkini dan Terpercaya</p>
    </div>
</section>

<!-- Main Content -->
<main class="container mx-auto px-4 py-12">
    <!-- Company Overview -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-12 border border-gray-100">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Perisai Demokrasi Bangsa Media Group</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Perisai Demokrasi Bangsa adalah platform media digital terdepan yang menyajikan informasi aktual, berita terkini, dan analisis mendalam untuk masyarakat Indonesia. Kami berkomitmen menyampaikan berita yang akurat, cepat, dan terpercaya.</p>
        </div>

        <!-- Company Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="text-center p-6 bg-amber-50 rounded-lg border border-amber-100">
                <div class="w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">2018</h3>
                <p class="text-gray-600">Tahun Berdiri</p>
            </div>
            
            <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">150+</h3>
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
                <p class="text-lg leading-relaxed text-gray-300">Menjadi platform media digital terpercaya nomor satu di Indonesia yang mengedukasi dan memberdayakan masyarakat melalui informasi yang akurat dan berkualitas.</p>
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
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">Menyajikan berita yang akurat, cepat, dan terverifikasi</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">Mengedepankan etika jurnalistik dan independensi</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">Memberikan platform untuk suara masyarakat</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">Mengembangkan teknologi untuk pengalaman berita yang lebih baik</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-amber-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">Menjalin kemitraan strategis dengan berbagai institusi</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Nilai Perusahaan -->
        <div class="mb-12">
            <h3 class="text-3xl font-bold text-gray-800 text-center mb-8">Nilai Perusahaan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Integritas</h4>
                    <p class="text-gray-600">Selalu menjunjung tinggi kejujuran dan kebenaran</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Profesionalisme</h4>
                    <p class="text-gray-600">Bekerja dengan standar tertinggi</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Inovasi</h4>
                    <p class="text-gray-600">Terus berkembang dan beradaptasi dengan perubahan</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Kolaborasi</h4>
                    <p class="text-gray-600">Bersinergi untuk hasil yang lebih baik</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200 hover:border-amber-400 hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-3">Pelayanan Publik</h4>
                    <p class="text-gray-600">Mengedepankan kepentingan masyarakat</p>
                </div>
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
                            <p class="text-gray-600">Gedung Media Center Lt. 5, Jl. Prof. Dr. Satrio No. 123, Jakarta Selatan 12950</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm mr-4">
                            <i class="fas fa-phone text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Telepon</h4>
                            <p class="text-gray-600">+62 21 1234 5678</p>
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
                            <p class="text-gray-600">info@perisaidemokrasibangsa.com</p>
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
    </div>
</main>
HTML;

        // Only create if not exists
        if (!Page::where('slug', 'profile-perusahaan')->exists()) {
            Page::create([
                'title' => 'Tentang Kami',
                'slug' => 'profile-perusahaan',
                'content' => $content,
                'is_published' => true,
            ]);
        }
    }
}
