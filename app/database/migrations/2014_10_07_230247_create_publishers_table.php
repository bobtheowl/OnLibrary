<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('publishers', function ($table) {
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
        Schema::dropIfExists('publishers');
    }//end down()
}//end class CreatePublishersTable

//end file 2014_10_07_230247_create_publishers_table.php
