<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Post::factory(100)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);

        //User::factory(10)->create(); esto ya se puede hacen dentro de UserSeeder asi podemos controlar los datos que se insertan

    }
}
