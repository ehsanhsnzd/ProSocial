<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(false);
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('no action');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('company_id')->nullable(true);
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->unsignedInteger('company_room_id')->nullable(true);
            $table->foreign('company_room_id')->references('company_room_id')->on('company_rooms')->onDelete('cascade');
            $table->boolean('is_active')->default(true)->nullable(false);
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
        Schema::dropIfExists('posts');
    }
}
