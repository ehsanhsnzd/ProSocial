<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
//            $table->increments('connections_id');
            $table->unsignedInteger('user_from_id');
            $table->foreign("user_from_id")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedInteger('user_to_id');
            $table->foreign("user_to_id")->references("id")->on("users")->onDelete('cascade');
            $table->primary(['user_from_id', 'user_to_id']);
            $table->boolean('is_blocked')->default(false)->nullable(false);
            $table->boolean('is_accept')->default(false)->nullable(false);
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
        Schema::dropIfExists('connections');
    }
}
