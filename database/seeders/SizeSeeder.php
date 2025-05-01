<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            [
                'name' => 'Small',
                'size_code' => 'S'
            ],
            [
                'name' => 'Large',
                'size_code' => 'L'
            ],
            [
                'name' => 'Medium',
                'size_code' => 'M'
            ]
        ];

        Size::insert($sizes);
    }
}
