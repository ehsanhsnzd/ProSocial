<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('service_id');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->unsignedInteger('service_type_id');
            $table->foreign('service_type_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('category_id')->nullable(true);
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('no action');
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(true);
            $table->unsignedInteger('price')->default(0)->nullable(false);
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
        Schema::dropIfExists('services');
    }
}
