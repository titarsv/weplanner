<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            [
                'user_id' => 5,
                'href' => 'no_image.jpg',
                'title' => 'Изображение не выбрано',
                'type' => 'jpg',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 1,
                'href' => 'news-banner.jpg',
                'title' => 'news-banner.jpg',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => 'bitmap-1.png',
                'title' => 'bitmap-1.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 6,
                'href' => 'bitmap-2.png',
                'title' => 'bitmap-2.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 7,
                'href' => 'bitmap-3.png',
                'title' => 'bitmap-3.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 8,
                'href' => 'bitmap-4.png',
                'title' => 'bitmap-4.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 9,
                'href' => 'bitmap-5.png',
                'title' => 'bitmap-5.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 10,
                'href' => 'bitmap-6.png',
                'title' => 'bitmap-6.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '1.png',
                'title' => '1.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '2.png',
                'title' => '2.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '3.png',
                'title' => '3.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '4.png',
                'title' => '4.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '5.png',
                'title' => '5.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '6.png',
                'title' => '6.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '7.png',
                'title' => '7.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '8.png',
                'title' => '8.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '9.png',
                'title' => '9.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '10.png',
                'title' => '10.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '11.png',
                'title' => '11.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '12.png',
                'title' => '12.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '13.png',
                'title' => '13.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '14.png',
                'title' => '14.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '15.png',
                'title' => '15.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '16.png',
                'title' => '16.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '17.png',
                'title' => '17.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '18.png',
                'title' => '18.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '19.png',
                'title' => '19.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '20.png',
                'title' => '20.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '21.png',
                'title' => '21.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => '22.png',
                'title' => '22.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => 'bitmap-tavernetta.png',
                'title' => 'bitmap-tavernetta.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => 'bitmap-tavernetta.png',
                'title' => 'bitmap-tavernetta.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 5,
                'href' => 'bitmap-tavernetta.png',
                'title' => 'bitmap-tavernetta.png',
                'type' => 'png',
                'parent_type' => '',
                'parent_id' => 0,
                'data' => '[]',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
