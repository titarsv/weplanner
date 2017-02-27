<?php

use Illuminate\Database\Seeder;

class CategoryAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('category_attributes')->insert([
            [
                'category_id' => 18,
                'attribute_id' => 1,
            ],
        ]);
    }
}
