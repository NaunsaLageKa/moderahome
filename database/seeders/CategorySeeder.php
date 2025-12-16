<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Living Room',
                'slug' => 'living-room',
                'description' => 'Furniture for your living room',
                'is_active' => true,
            ],
            [
                'name' => 'Bedroom',
                'slug' => 'bedroom',
                'description' => 'Furniture for your bedroom',
                'is_active' => true,
            ],
            [
                'name' => 'Dining',
                'slug' => 'dining',
                'description' => 'Dining room furniture',
                'is_active' => true,
            ],
            [
                'name' => 'Office',
                'slug' => 'office',
                'description' => 'Office furniture',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
