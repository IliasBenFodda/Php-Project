<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'Over-ear Bluetooth headphones with noise cancellation and 30-hour battery life.',
                'price' => 89.99,
                'stock' => 25,
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Fitness tracking, heart-rate monitor, and notifications on your wrist.',
                'price' => 149.00,
                'stock' => 15,
            ],
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Soft 100% cotton t-shirt, available in multiple sizes.',
                'price' => 19.99,
                'stock' => 100,
            ],
            [
                'name' => 'Denim Jacket',
                'description' => 'Classic blue denim jacket with a relaxed fit.',
                'price' => 59.50,
                'stock' => 40,
            ],
            [
                'name' => 'Ceramic Coffee Mug',
                'description' => '350ml ceramic mug, microwave and dishwasher safe.',
                'price' => 12.99,
                'stock' => 200,
            ],
            [
                'name' => 'Stainless Steel Water Bottle',
                'description' => 'Insulated bottle keeps drinks cold for 24 hours.',
                'price' => 24.99,
                'stock' => 60,
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'image' => null,
            ]);
        }
    }
}