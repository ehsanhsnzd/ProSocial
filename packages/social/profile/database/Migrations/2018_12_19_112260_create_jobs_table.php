<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('job_id');
            $table->string('title')->nullable(false);
            $table->unsignedInteger('job_type_id');
            $table->foreign('job_type_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('job_from_id');
            $table->foreign('job_from_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('job_to_id');
            $table->foreign('job_to_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('headline')->nullable(true);
            $table->string('description')->nullable(true);
            $table->string('company_name')->nullable(true);
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('no action');
            $table->boolean('currently')->default(false)->nullable(false);
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
        Schema::dropIfExists('jobs');
    }
}
