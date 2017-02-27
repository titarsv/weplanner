<?php

use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('attributes')->insert([
            [
                'name' => 'Кухня',
                'name_en' => 'Kitchen'
            ]
        ]);
    }
}
