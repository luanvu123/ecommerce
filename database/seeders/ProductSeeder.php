<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Thêm sản phẩm được chỉ định
        $products = [
            [
                'name' => 'Điện thoại iPhone X',
                'slug' => 'dien-thoai-iphone-x',
                'image_product' => 'iphone-x.jpg',
                'detail' => 'Chi tiết điện thoại iPhone X',
                'price' => 10000000,
                'reduced_price' => 9000000,
                'category_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Dell XPS 15',
                'slug' => 'laptop-dell-xps-15',
                'image_product' => 'dell-xps-15.jpg',
                'detail' => 'Chi tiết laptop Dell XPS 15',
                'price' => 20000000,
                'reduced_price' => 18000000,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các sản phẩm khác vào đây
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Thêm 8 sản phẩm ngẫu nhiên
        for ($i = 0; $i < 8; $i++) {
            Product::create([
                'name' => $faker->sentence(3),
                'slug' => $faker->slug,
                'image_product' => $faker->imageUrl(200, 200),
                'detail' => $faker->paragraph,
                'price' => $faker->numberBetween(1000000, 5000000),
                'reduced_price' => $faker->numberBetween(800000, 4000000),
                'category_id' => $faker->numberBetween(4, 11),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

