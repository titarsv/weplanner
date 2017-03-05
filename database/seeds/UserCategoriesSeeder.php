<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU');

        for($i = 1; $i <= 55; $i++) {
            Db::table('user_categories')->insert([
                [
                    'user_id' => $i,
                    'category_id' => $faker->numberBetween(1, 2)
                ],
            ]);
        }
    }
}
