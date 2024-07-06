<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'slug'=> Str::slug($faker->sentence),
                'content' => '
                    <h2>' . $faker->sentence . '</h2>
                    <p>' . $faker->paragraph . '</p>
                    <ul>
                        <li>' . $faker->sentence . '</li>
                        <li>' . $faker->sentence . '</li>
                        <li>' . $faker->sentence . '</li>
                    </ul>
                ',
                'tags' => json_encode($faker->words(3)),
                'image' => 'https://placehold.co/600x400',
                'author' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
