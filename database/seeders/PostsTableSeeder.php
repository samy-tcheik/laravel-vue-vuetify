<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Post::truncate();
        Post::create([
            'name' => 'plaquiste',
            'base_salary' => 1200,
        ]);

        Post::create([
            'name' => 'preparateur',
            'base_salary' => 1000,
        ]);

        Post::create([
            'name' => 'serveur',
            'base_salary' => 800,
        ]);

        Post::create([
            'name' => 'manager',
            'base_salary' => 1500
        ]);
    }
}
