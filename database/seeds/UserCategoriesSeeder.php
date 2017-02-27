<?php

use Illuminate\Database\Seeder;

class UserCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('user_categories')->insert([
            [
                'user_id' => 1,
                'category_id' => 2
            ],
        ]);
    }
}
