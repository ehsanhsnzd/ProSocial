<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('image_id');
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('path')->nullable(false);
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
        Schema::dropIfExists('images');
    }
}
