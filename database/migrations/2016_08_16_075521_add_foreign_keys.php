<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('topics', function ($table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('subscribed_users', function ($table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('message_relays', function ($table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
        Schema::table('logs', function ($table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->foreign('message_relay_id')->references('id')->on('message_relays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('topics', function ($table) {
            $table->dropForeign(['owner_id']);
        });
        Schema::table('subscribed_users', function ($table) {
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::table('message_relays', function ($table) {
            $table->dropForeign(['topic_id']);
        });
        Schema::table('logs', function ($table) {
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['message_relay_id']);
        });
    }

}
