<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('author_book', function ($table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });//end Schema::create()
    }//end up()

    /**
     * Reverse the migrations.
     *
     * @retval null
     */
    public function down()
    {
        Schema::dropIfExists('author_book');
    }//end down()
}//end class CreateAuthorbookTable

//end file 2014_10_07_230343_create_authorbook_table.php
