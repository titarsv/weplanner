<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('services')->insert([
            [
                'name' => 'Видеосъёмка',
                'name_en' => 'Videography',
                'category_id' => 1
            ],
            [
                'name' => 'Видеомонтаж',
                'name_en' => 'Video editing',
                'category_id' => 1
            ],
            [
                'name' => 'Свадебный распорядитель',
                'name_en' => 'Wedding manager',
                'category_id' => 2
            ],
            [
                'name' => 'Свадебный регистратор',
                'name_en' => 'Wedding registrar',
                'category_id' => 2
            ],
            [
                'name' => 'Ведущий праздников',
                'name_en' => 'Senior holidays',
                'category_id' => 2
            ],
            [
                'name' => 'Ведущий на свадьбу',
                'name_en' => 'Leading to the wedding',
                'category_id' => 2
            ],
            [
                'name' => 'Актер театра и кино',
                'name_en' => 'Theater and film actor',
                'category_id' => 2
            ],
            [
                'name' => 'Камеди клаб',
                'name_en' => 'Comedy Club',
                'category_id' => 2
            ],
            [
                'name' => 'Ведущий радио',
                'name_en' => 'Radio leading',
                'category_id' => 2
            ],
        ]);
    }
}
