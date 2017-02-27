<?php

use Illuminate\Database\Seeder;

class UserAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('user_attributes')->insert([
            [
                'user_id' => 1,
                'attribute_value_id' => 1,
            ],
        ]);
    }
}