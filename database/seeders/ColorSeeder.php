<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'name' => 'red',
                'color_code' => '#444'
            ],
            [
                'name' => 'blue',
                'color_code' => '#444'
            ],
            [
                'name' => 'black',
                'color_code' => '#444'
            ],
            [
                'name' => 'gray',
                'color_code' => '#444'
            ],
            [
                'name' => 'pink',
                'color_code' => '#444'
            ],
            [
                'name' => 'green',
                'color_code' => '#444'
            ],
            [
                'name' => 'yellow',
                'color_code' => '#444'
            ]
        ];

        Color::insert($colors);
    }
}
