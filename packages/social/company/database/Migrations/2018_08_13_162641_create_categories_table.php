<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->unsignedInteger('category_type_id');
            $table->foreign('category_type_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->unsignedInteger('parent_id')->nullable(true);
            $table->foreign('parent_id')->references('category_id')->on('categories')->onDelete('no action');
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
        Schema::dropIfExists('categories');
    }
}
