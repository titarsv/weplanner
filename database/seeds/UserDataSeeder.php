<?php

use Illuminate\Database\Seeder;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 55; $i++){
            Db::table('users_data')->insert([
                [
                    'user_id'   => $i,
                    'subscribe' => 0
                ]
            ]);
        }
    }
}
