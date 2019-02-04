<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('project_size_id');
            $table->foreign('project_size_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('project_type_id');
            $table->foreign('project_type_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('album_id')->nullable(true);;
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('no action');
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(false);
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
        Schema::dropIfExists('projects');
    }
}
