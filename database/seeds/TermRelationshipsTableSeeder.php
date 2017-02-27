<?php

use Illuminate\Database\Seeder;

class TermRelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('term_relationships')->insert([
            ['object_id' => '1','term_taxonomy_id' => '36','term_order' => '0'],
            ['object_id' => '2','term_taxonomy_id' => '36','term_order' => '0'],
            ['object_id' => '3','term_taxonomy_id' => '36','term_order' => '0'],
            ['object_id' => '5','term_taxonomy_id' => '36','term_order' => '0'],
            ['object_id' => '5','term_taxonomy_id' => '38','term_order' => '0'],
            ['object_id' => '28','term_taxonomy_id' => '35','term_order' => '0'],
            ['object_id' => '30','term_taxonomy_id' => '35','term_order' => '0'],
            ['object_id' => '31','term_taxonomy_id' => '34','term_order' => '0'],
            ['object_id' => '31','term_taxonomy_id' => '35','term_order' => '0']
        ]);
    }
}
