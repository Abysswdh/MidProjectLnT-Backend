<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiksi',
                'description' => 'Novel, cerpen, dan karya sastra fiksi lainnya',
            ],
            [
                'name' => 'Non-Fiksi',
                'description' => 'Buku pengetahuan umum, biografi, dan sejarah',
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Buku tentang komputer, pemrograman, dan teknologi informasi',
            ],
            [
                'name' => 'Sains',
                'description' => 'Buku ilmu pengetahuan alam, fisika, kimia, dan biologi',
            ],
            [
                'name' => 'Bisnis',
                'description' => 'Buku ekonomi, manajemen, dan kewirausahaan',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
