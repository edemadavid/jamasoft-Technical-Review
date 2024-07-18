<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websites = [
            [
                'title' => 'TechCrunch',
                'url' => 'https://techcrunch.com/',
                'description' => 'Tech news, reviews, and analysis.',
                'category_id' => 1, // Assuming 'Technology' category has id 1
                'user_id'=> 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lonely Planet',
                'url' => 'https://www.lonelyplanet.com/',
                'description' => 'Travel guides and inspiration.',
                'category_id' => 2, // Assuming 'Travel' category has id 2
                'user_id'=> 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more websites as needed
        ];

        DB::table('websites')->insert($websites);

    }
}
