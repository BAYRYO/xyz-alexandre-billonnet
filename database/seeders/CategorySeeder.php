<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Soul', 'tracks_count' => 0],
            ['name' => 'Ambient', 'tracks_count' => 0],
            ['name' => 'Pop', 'tracks_count' => 0],
            ['name' => 'Rap', 'tracks_count' => 0],
            ['name' => 'Funk', 'tracks_count' => 0],
            ['name' => 'Rock', 'tracks_count' => 0],
            ['name' => 'Reggae / Dub', 'tracks_count' => 0],
            ['name' => 'Techno', 'tracks_count' => 0],
            ['name' => 'Electro', 'tracks_count' => 0],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
