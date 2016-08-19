<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageRelaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_relays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned();
            $table->index('topic_id');            
            $table->string('title')->nullable();
            $table->mediumText('short_message')->nullable();
            $table->mediumText('long_message')->nullable();
            $table->string('action_url')->nullable();
            $table->index('action_url');
            $table->string('your_system_id')->nullable();
            $table->index('your_system_id');
            $table->string('end_point')->nullable();
            $table->index('end_point');
            $table->string('secret')->nullable();
            $table->index('secret');            
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
        Schema::drop('message_relays');
    }
}
