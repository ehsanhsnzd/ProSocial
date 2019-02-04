<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('companies',function(Blueprint $table){
//            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('no action');
//        });




//        Schema::table('profiles',function(Blueprint $table){
//            $table->foreign('user_id')->references('id')->on('users');
//        });

//                Schema::table('users',function(Blueprint $table){
//            $table->foreign('id')->references('user_id')->on('profiles');
//        });


        Schema::table('users',function(Blueprint $table){
            $table->foreign('image_id')->references('image_id')->on('images')->onDelete('no action');
        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
