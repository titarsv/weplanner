<?php

use Illuminate\Database\Seeder;

class UserServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('user_services')->insert([
            [
                'user_id' => 1,
                'service_id' => 5,
                'price' => 50,
            ],
        ]);
    }
}
