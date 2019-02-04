<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeedsSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needs_skills', function (Blueprint $table) {
            $table->unsignedInteger('need_id');
            $table->foreign('need_id')->references('need_id')->on('needs')->onDelete('no action');
            $table->unsignedInteger('skill_id');
            $table->foreign('skill_id')->references('skill_id')->on('skills')->onDelete('no action');
            $table->integer('percent')->default(100)->nullable(false);
            $table->primary(['need_id', 'skill_id']);
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
        Schema::dropIfExists('needs_skills');
    }
}
