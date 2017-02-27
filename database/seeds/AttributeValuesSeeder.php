<?php

use Illuminate\Database\Seeder;

class AttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('attribute_values')->insert([
            [
                'name' => 'Итальянская',
                'name_en' => 'Italian',
                'attribute_id' => 1
            ],
            [
                'name' => 'Европейская',
                'name_en' => 'European',
                'attribute_id' => 1
            ]
        ]);
    }
}