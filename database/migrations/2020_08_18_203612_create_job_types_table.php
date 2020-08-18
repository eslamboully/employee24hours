<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('job_types')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('job_type_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_type_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique(['job_type_id', 'locale']);
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_types');
    }
}
