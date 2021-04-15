<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('lt_LT');

        $architects = 15;
        $projects = 30;

        foreach(range(1, $architects) as $_) {
            DB::table('architects')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'about' => $faker->text(),
            ]);
        }

        foreach(range(1, $projects) as $_) {
            DB::table('projects')->insert([
                'name' => $faker->word(),
                'location' => $faker->country(),
                'about' => $faker->text(),
                'architect_id' => rand(1, $architects)
            ]);
        }

    }
}
