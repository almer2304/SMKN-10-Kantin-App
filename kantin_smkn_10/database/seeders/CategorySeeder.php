<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Makanan', 'slug' => 'makanan', 'description' => 'Berbagai jenis makanan'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Berbagai jenis minuman'],
            ['name' => 'Snack', 'slug' => 'snack', 'description' => 'Cemilan ringan'],
            ['name' => 'Stationery', 'slug' => 'stationery', 'description' => 'Alat tulis dan perlengkapan sekolah'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}