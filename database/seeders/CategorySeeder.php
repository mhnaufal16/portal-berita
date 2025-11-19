<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Halaman Statis',
                'slug' => 'halaman-statis',
                'description' => 'Untuk halaman statis seperti About, Contact, dll'
            ],
            [
                'name' => 'Berita', 
                'slug' => 'berita',
                'description' => 'Untuk konten berita terbaru'
            ],
            [
                'name' => 'Artikel',
                'slug' => 'artikel', 
                'description' => 'Untuk konten artikel blog'
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Untuk pengumuman resmi'
            ]
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}