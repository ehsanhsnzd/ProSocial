<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->unsignedInteger('user_from_id');
            $table->foreign("user_from_id")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedInteger('user_to_id');
            $table->foreign("user_to_id")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign("album_id")->references("album_id")->on("albums")->onDelete('no action');
            $table->string("message")->nullable(false);
            $table->tinyInteger("seen")->default(0);
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
        Schema::dropIfExists('messages');
    }
}
