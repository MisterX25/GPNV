<?php

/*
  Last update : 2017.01.19
  Last Update by : Thomas Marcoup
*/

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('friendlyid');
            $table->string('firstname', 20);
            $table->string('lastname', 20);
            $table->string('mail', 45);
            $table->integer('role_id')->unsigned();
            $table->integer('class_id')->unsigned()->nullable(true);
            $table->integer('state_id')->unsigned();
            $table->string('password', 100);
            $table->longText('remember_token');
            $table->string('avatar', 45);
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('users', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
