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

        foreach(range(1, 25) as $_) {
            DB::table('architects')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'about' => $faker->text(),
            ]);
        }
    }
}
