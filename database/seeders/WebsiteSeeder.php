<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::insert([
            [
                'name' => 'News',
                'url' => 'news.example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Healthy news',
                'url' => 'healthynews.example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports',
                'url' => 'sports.example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
