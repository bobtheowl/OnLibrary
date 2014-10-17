<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('authors', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });//end Schema::create()
    }//end up()

    /**
     * Reverse the migrations.
     *
     * @retval null
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }//end down()
}//end class CreateAuthorsTable

//end file 2014_10_07_230315_create_authors_table.php
