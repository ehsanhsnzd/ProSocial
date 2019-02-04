<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_projects', function (Blueprint $table) {
            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('no action');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('no action');
            $table->boolean('is_active')->default(true)->nullable(false);
            $table->primary(['company_id', 'project_id']);
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
        Schema::dropIfExists('companies_projects');
    }
}
