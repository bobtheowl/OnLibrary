<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('books', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('isbn');
            $table->integer('publisher_id')->unsigned();
            $table->integer('series_id')->nullable()->unsigned();
            $table->timestamps();
            
            $table->foreign('publisher_id')
                ->references('id')
                ->on('publishers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('series_id')
                ->references('id')
                ->on('series')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });//end Schema::create()
    }//end up()

    /**
     * Reverse the migrations.
     *
     * @retval null
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }//end down()
}//end class CreateBooksTable

//end file 2014_10_07_230310_create_books_table.php
