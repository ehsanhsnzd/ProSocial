<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('education_id');
            $table->string('school')->nullable(false);
            $table->unsignedInteger('degree_id');
            $table->foreign('degree_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('from_id');
            $table->foreign('from_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('to_id');
            $table->foreign('to_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('no action');
            $table->unsignedInteger('meta_data_id')->nullable(true);
            $table->foreign('meta_data_id')->references('meta_data_id')->on('meta_datas')->onDelete('no action');
            $table->string('field')->nullable(true);
            $table->string('grade')->nullable(true);
            $table->string('activity')->nullable(true);
            $table->string('description')->nullable(true);
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
        Schema::dropIfExists('educations');
    }
}
