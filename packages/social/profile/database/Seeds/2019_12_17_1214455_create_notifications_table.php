<?php
//
//use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
//
//class CreateNotificationsTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('notifications', function (Blueprint $table) {
//            $table->increments('notification_id');
//            $table->unsignedInteger('user_id');
//            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
//            $table->string("title")->nullable(false);
//            $table->string("description")->nullable(true);
//            $table->unsignedInteger('type_id');
//            $table->foreign("type_id")->references("setting_id")->on("settings")->onDelete('cascade');
//            $table->tinyInteger("seen")->default(0);
//            $table->boolean('is_active')->default(true)->nullable(false);
//            $table->timestamps();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('notifications');
//    }
//}
