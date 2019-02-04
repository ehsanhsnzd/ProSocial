<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('company_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('company_size_id');
            $table->foreign('company_size_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('image_id')->nullable(true);
            $table->foreign('image_id')->references('image_id')->on('images')->onDelete('no action');
            $table->unsignedInteger('album_id')->nullable(true);
            $table->foreign('album_id')->references('album_id')->on('albums')->onDelete('no action');
            $table->unsignedInteger('company_type_id');
            $table->foreign('company_type_id')->references('setting_id')->on('settings')->onDelete('no action');
            $table->unsignedInteger('meta_data_id')->nullable(true);
            $table->foreign('meta_data_id')->references('meta_data_id')->on('meta_datas')->onDelete('no action');
            $table->string('title')->nullable(false);
            $table->string('page_name')->nullable(false)->unique();
            $table->string('website')->nullable(true);
            $table->string('description')->nullable(true);
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
        Schema::dropIfExists('companies');
    }
}
