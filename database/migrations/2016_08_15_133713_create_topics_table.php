<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->index('title');
            $table->integer('owner_id')->unsigned();
            $table->index('owner_id');
            $table->string('join_code');
            $table->index('join_code');
            $table->enum('relay', ['on demand', 'if not pinged']);
            $table->tinyInteger('active')->nullable();
            $table->tinyInteger('email')->nullable();
            $table->tinyInteger('sms')->nullable();
            $table->tinyInteger('pn')->nullable();
            $table->Integer('occurance')->nullable();
            $table->Integer('intervals')->nullable();
            $table->enum('time_unit', ['minutes', 'hours', 'days', 'weeks', 'months'])->nullable();
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
        Schema::drop('topics');
    }
}
