<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->unsignedInteger("country_id")->nullable(true);
            $table->foreign('country_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger("state_id")->nullable(true);
            $table->foreign('state_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger("city_id")->nullable(true);
            $table->foreign('city_id')->references('setting_id')->on('settings')->onDelete('no action');
//            $table->string("username")->unique()->nullable(false);
            $table->string("zip")->nullable(true);
            $table->string("description")->nullable(true);
            $table->unsignedInteger("user_id")->nullable(true);
            $table->integer("phone")->nullable(true);
            $table->string("address")->nullable(true);
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
        Schema::dropIfExists('profiles');
    }
}
