<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('series', function ($table) {
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
        Schema::dropIfExists('series');
    }//end down()
}//end class CreateSeriesTable

//end file 2014_10_07_230304_create_series_table.php
