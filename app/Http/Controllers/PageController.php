<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function showProfile()
    {
        // Cari halaman dengan slug 'profile-perusahaan'
        $page = Page::where('slug', 'profile-perusahaan')->first();

        // Jika tidak ada, tampilkan default tanpa membuat database record
        if (!$page) {
            $profileData = [
                'nama_perusahaan' => 'Perisai Demokrasi Bangsa Media Group',
                'tagline' => 'Informasi Terkini dan Terpercaya',
                'deskripsi' => 'Perisai Demokrasi Bangsa adalah platform media digital terdepan yang menyajikan informasi aktual, berita terkini, dan analisis mendalam untuk masyarakat Indonesia. Kami berkomitmen menyampaikan berita yang akurat, cepat, dan terpercaya.',
                'alamat' => 'Gedung Media Center Lt. 5, Jl. Prof. Dr. Satrio No. 123, Jakarta Selatan 12950',
                'telepon' => '+62 21 1234 5678',
                'email' => 'info@perisaidemokrasibangsa.com',
                'tahun_berdiri' => '2018',
                'jumlah_karyawan' => '150+',
                'visi' => 'Menjadi platform media digital terpercaya nomor satu di Indonesia yang mengedukasi dan memberdayakan masyarakat melalui informasi yang akurat dan berkualitas.',
                'misi' => [
                    'Menyajikan berita yang akurat, cepat, dan terverifikasi',
                    'Mengedepankan etika jurnalistik dan independensi',
                    'Memberikan platform untuk suara masyarakat',
                    'Mengembangkan teknologi untuk pengalaman berita yang lebih baik',
                    'Menjalin kemitraan strategis dengan berbagai institusi'
                ],
                'nilai_perusahaan' => [
                    'Integritas' => 'Selalu menjunjung tinggi kejujuran dan kebenaran',
                    'Profesionalisme' => 'Bekerja dengan standar tertinggi',
                    'Inovasi' => 'Terus berkembang dan beradaptasi dengan perubahan',
                    'Kolaborasi' => 'Bersinergi untuk hasil yang lebih baik',
                    'Pelayanan Publik' => 'Mengedepankan kepentingan masyarakat'
                ]
            ];

            return view('pages.profile-default', compact('profileData'));
        }

        // Tampilkan halaman dari database
        return view('pages.profile', compact('page'));
    }
}