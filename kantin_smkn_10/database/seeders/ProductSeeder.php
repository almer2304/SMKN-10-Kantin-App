<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Nasi Goreng',
                'slug' => 'nasi-goreng',
                'description' => 'Nasi goreng spesial dengan telur dan ayam',
                'price' => 15000,
                'stock' => 50,
                'category_id' => 1,
            ],
            [
                'name' => 'Mie Goreng',
                'slug' => 'mie-goreng',
                'description' => 'Mie goreng dengan sayuran dan telur',
                'price' => 12000,
                'stock' => 40,
                'category_id' => 1,
            ],
            [
                'name' => 'Es Teh',
                'slug' => 'es-teh',
                'description' => 'Es teh manis segar',
                'price' => 3000,
                'stock' => 100,
                'category_id' => 2,
            ],
            [
                'name' => 'Air Mineral',
                'slug' => 'air-mineral',
                'description' => 'Air mineral botol 600ml',
                'price' => 4000,
                'stock' => 80,
                'category_id' => 2,
            ],
            [
                'name' => 'Keripik Kentang',
                'slug' => 'keripik-kentang',
                'description' => 'Keripik kentang original 50gr',
                'price' => 5000,
                'stock' => 60,
                'category_id' => 3,
            ],
            [
                'name' => 'Buku Tulis',
                'slug' => 'buku-tulis',
                'description' => 'Buku tulis 38 lembar',
                'price' => 3000,
                'stock' => 200,
                'category_id' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}