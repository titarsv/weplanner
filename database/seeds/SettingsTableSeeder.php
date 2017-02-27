<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key'   => 'meta_title',
                'value' => 'Weplanner',
                'autoload'  => 1
            ],
            [
                'key'   => 'meta_description',
                'value' => 'Weplanner',
                'autoload'  => 1
            ],
            [
                'key'   => 'meta_keywords',
                'value' => 'Weplanner',
                'autoload'  => 1
            ],
            [
                'key'   => 'about',
                'value' => 'Nulla sit amet mollis odio, vitae sodales diam. Suspendisse vehicula sapien ut pellentesque suscipit. Nullam eleifend efficitur nunc sit amet porttitor. Mauris eu nisl gravida, interdum lorem ut, finibus mi. Donec enim quam, ullamcorper at nisl a, congue dignissim nisi. Etiam condimentum ultrices orci vel volutpat.',
                'autoload'  => 1
            ],
            [
                'key'   => 'terms',
                'value' => 'Политика безопасности',
                'autoload'  => 0
            ],
            [
                'key'   => 'branches',
                'value' => json_encode([
                    ['phones' => ['050-417-96-65','099-999-99-99','067-000-00-00'], 'city' => 'Харьков', 'address' => 'ул. Дудинской, 1А'],
//                    ['phones' => ['050-417-96-65','055-555-555-555','067-000-00-00'], 'city' => 'Киев', 'address' => 'ул. Владимирская 39'],
//                    ['phones' => ['050-417-96-65','033-333-33-33','067-000-00-00'], 'city' => 'Одесса', 'address' => 'ул. Большая Арнаутская 14'],
//                    ['phones' => ['050-417-96-65','011-111-11-11','067-000-00-00'], 'city' => 'Днепр', 'address' => 'ул. Каруны 27']
                ]),
                'autoload'  => 1
            ],
            [
                'key'   => 'site_email',
                'value' => 'titarsv@yandex.ru',
                'autoload'  => 0
            ],
            [
                'key'   => 'notify_emails',
                'value' => json_encode(['admin@laravel.com', 'manager@laravel.com']),
                'autoload'  => 0
            ],
            [
                'key'   => 'socials',
                'value' => json_encode([
                    'facebook' => '',
                    'vkontakte' => '',
                    'instagram' => '',
                    'youtube'   => '',
                ]),
                'autoload'  => 0
            ]
        ]);
    }
}
