<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('terms')->insert([
            ['name' => 'Видео','name_en' => 'Video','slug' => 'video','term_group' => '0'],
            ['name' => 'Ведущие','name_en' => 'Presenters','slug' => 'presenters','term_group' => '0'],
            ['name' => 'Диджеи','name_en' => 'DJ','slug' => 'dj','term_group' => '0'],
            ['name' => 'Площадки','name_en' => 'Venues','slug' => 'venues','term_group' => '0'],
            ['name' => 'Техническое обеспечение','name_en' => 'Technical support','slug' => 'tech-support','term_group' => '0'],
            ['name' => 'Музыкальная программа','name_en' => 'Music program','slug' => 'mus-prog','term_group' => '0'],
            ['name' => 'Шоу программа','name_en' => 'Show program','slug' => 'show-prog','term_group' => '0'],
            ['name' => 'Подарки','name_en' => 'Souvenirs','slug' => 'souvenirs','term_group' => '0'],
            ['name' => 'Звук','name_en' => 'Audio','slug' => 'audio','term_group' => '0'],
            ['name' => 'Танцевальная программа','name_en' => 'Dance program','slug' => 'dance-prog','term_group' => '0'],
            ['name' => 'Артисты','name_en' => 'Artists','slug' => 'artists','term_group' => '0'],
            ['name' => 'Транспорт','name_en' => 'Transport','slug' => 'transport','term_group' => '0'],
            ['name' => 'Аренда','name_en' => 'Rent','slug' => 'rent','term_group' => '0'],
            ['name' => 'Сотрудники','name_en' => 'Staff','slug' => 'staff','term_group' => '0'],
            ['name' => 'Дизайн и декор','name_en' => 'Design & Decor','slug' => 'decor','term_group' => '0'],
            ['name' => 'Цветы','name_en' => 'Flowers','slug' => 'flowers','term_group' => '0'],
            ['name' => 'Другое','name_en' => 'Other','slug' => 'other','term_group' => '0'],
            ['name' => 'Питание','name_en' => 'Catering','slug' => 'catering','term_group' => '0'],
            ['name' => 'Торты и кондитерские изделия','name_en' => 'Cakes and confectioner','slug' => 'cakes','term_group' => '0'],
            ['name' => 'Мужская одежда','name_en' => 'Men\'s Clothing','slug' => 'men-clothing','term_group' => '0'],
            ['name' => 'Аксессуары','name_en' => 'Clothing akksesuary','slug' => 'clothing-acces','term_group' => '0'],
            ['name' => 'Красота и здоровье','name_en' => 'Beauty and Health','slug' => 'beauty','term_group' => '0'],
            ['name' => 'Ювелирные изделия','name_en' => 'Jewelery','slug' => 'jewelery','term_group' => '0'],
            ['name' => 'Фотографы','name_en' => 'Photography','slug' => 'photo','term_group' => '0'],
            ['name' => 'Новости','name_en' => 'News','slug' => 'novosti','term_group' => '0'],
            ['name' => 'Страницы','name_en' => 'Pages','slug' => 'stranitsy','term_group' => '0'],
            ['name' => 'Новости портала','name_en' => 'Portal News','slug' => 'portal','term_group' => '0'],
            ['name' => 'Свадебная индустрия','name_en' => 'Wedding industry','slug' => 'industry','term_group' => '0'],
            ['name' => 'Свадебные события','name_en' => 'Wedding months','slug' => 'months','term_group' => '0'],
            ['name' => 'Мастер классы','name_en' => 'Master classes','slug' => 'masterclasses','term_group' => '0'],
            ['name' => 'Конкурсы','name_en' => 'Contests','slug' => 'contests','term_group' => '0']
        ]);
    }
}
