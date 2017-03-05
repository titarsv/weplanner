<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU');

        for($i = 1; $i <= 200; $i++) {
            Db::table('user_attributes')->insert([
                [
                    'user_id' => $faker->numberBetween(1, 55),
                    'attribute_value_id' => $faker->numberBetween(1, 2),
                    'price' => $faker->numberBetween(10, 1000),
                ],
            ]);
        }
    }
}