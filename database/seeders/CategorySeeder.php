<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create parent categories
        $computers = Category::create([
            'name' => 'Computers',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => null,
        ]);

        $phones = Category::create([
            'name' => 'Phones',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => null,
        ]);

        $accessories = Category::create([
            'name' => 'Accessories',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => null,
        ]);

        // Create sub-categories for Computers
        $desktops = Category::create([
            'name' => 'Desktops',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $computers->id,
        ]);

        $laptops = Category::create([
            'name' => 'Laptops',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $computers->id,
        ]);

        $tablets = Category::create([
            'name' => 'Tablets',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $computers->id,
        ]);

        // Create sub-categories for Phones
        $smartphones = Category::create([
            'name' => 'Smartphones',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $phones->id,
        ]);

        $featurePhones = Category::create([
            'name' => 'Feature Phones',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $phones->id,
        ]);

        // Create sub-categories for Accessories
        $cases = Category::create([
            'name' => 'Cases',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $accessories->id,
        ]);

        $headphones = Category::create([
            'name' => 'Headphones',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $accessories->id,
        ]);

        $chargers = Category::create([
            'name' => 'Chargers',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'parent_id' => $accessories->id,
        ]);
    }
}
