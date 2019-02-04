<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('password');
            $table->string('os')->nullable();
            $table->string('os_version')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('user_type')->nullable(false)->default(1);
            $table->foreign('user_type')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger("image_id")->default(1)->nullable(true);
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
        Schema::dropIfExists('users');
    }
}