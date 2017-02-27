<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomy', function (Blueprint $table) {
            $table->integer('term_taxonomy_id');
            $table->integer('term_id');
            $table->string('taxonomy');
            $table->text('description');
            $table->text('description_en');
            $table->integer('parent');
            $table->integer('count');
            $table->string('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('term_taxonomy');
    }
}