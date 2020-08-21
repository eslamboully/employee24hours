<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->bigInteger('job_type_id')->unsigned()->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade');

            $table->bigInteger('convention_id')->unsigned()->nullable();
            $table->foreign('convention_id')->references('id')->on('conventions')->onDelete('cascade');

            $table->string('work_from');
            $table->string('work_to');
            $table->string('work_days_in_week');
            $table->string('salary');
            $table->bigInteger('helper_type');
            $table->integer('status')->default(0);
            $table->text('refusal_details')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('job_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('description');
            $table->unique(['job_id', 'locale']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_translations');
    }
}
