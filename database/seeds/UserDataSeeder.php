<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU');

        for($i = 1; $i <= 55; $i++){
            $faker->seed($i);
            Db::table('users_data')->insert([
                [
                    'user_id'       => $i,
                    'country'       => 0,
                    'city'          => $faker->numberBetween(0, 2),
                    'address'       => $faker->streetAddress(),
                    'company'       => $faker->company(),
                    'average_bill'  => $faker->numberBetween(10, 1000),
                    'preview'       => $faker->realText(150),
                    'other_data'    => json_encode([
                        'url' => $faker->url(),
                        'gallery' => [31, 32, 33],
                        'about' => '<h3>'.$faker->realText(50).'</h3>'.'<p>'.$faker->realText(300).'</p>'.'<p>'.$faker->realText(300).'</p>'.'<p>'.$faker->realText(300).'</p>',

                    ]),
                    'rating'     => $faker->numberBetween(0, 5),
                    'subscribe'     => 0
                ]
            ]);
        }
    }
}
