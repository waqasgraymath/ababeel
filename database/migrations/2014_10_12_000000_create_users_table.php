<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->index('name');
            $table->string('email')->unique();
            $table->index('email');
            $table->string('password');
            $table->index('password');
            $table->string('phone');
            $table->index('phone');
            $table->integer('country_code')->nullable();
            $table->string('time_zone');
            $table->index('time_zone');
            $table->string('verification_code');
            $table->tinyInteger('is_verified')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
