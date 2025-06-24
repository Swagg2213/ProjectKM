<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Seminar'],
            ['name' => 'Panitia'],
            ['name' => 'Pengmas'],
            ['name' => 'Bakmi'],
            ['name' => 'Lainnya'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}