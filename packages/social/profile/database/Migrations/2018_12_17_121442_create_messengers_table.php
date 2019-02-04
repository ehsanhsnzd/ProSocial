<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messengers', function (Blueprint $table) {
            $table->increments('messenger_id');
            $table->unsignedInteger('user_id');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedInteger("type_id");
            $table->foreign('type_id')->references('setting_id')->on('settings');
            $table->string("messenger_value")->nullable(false);
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
        Schema::dropIfExists('messengers');
    }
}
