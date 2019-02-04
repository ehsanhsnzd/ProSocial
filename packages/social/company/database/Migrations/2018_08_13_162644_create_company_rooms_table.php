<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_rooms', function (Blueprint $table) {
            $table->increments('company_room_id');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->string('title')->nullable(false);
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
        Schema::dropIfExists('company_rooms');
    }
}
