<?php

namespace Database\Seeders;

use App\Models\Category;
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
                'name' => 'Cat A',
                'slug' => 'cat-a'
            ],
            [
                'name' => 'Cat B',
                'slug' => 'cat-b'
            ],
            [
                'name' => 'Cat C',
                'slug' => 'cat-c'
            ],
            [
                'name' => 'Cat D',
                'slug' => 'cat-d'
            ],
        ];

        Category::insert($categories);
    }
}
