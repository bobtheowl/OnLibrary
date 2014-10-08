<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @retval null
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username');
            $table->string('email_address');
            $table->string('password');
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }//end down()
}//end class CreateUsersTable

//end file 2014_10_07_230219_create_users_table.php
