<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_infos', function (Blueprint $table) {
            $table->increments('meta_info_id');
            $table->unsignedInteger('meta_data_id');
            $table->foreign('meta_data_id')->references('meta_data_id')->on('meta_datas')->onDelete('cascade');;
            $table->string("key")->nullable(false);
            $table->string("value")->nullable(false);
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
        Schema::dropIfExists('meta_Infos');
    }
}
