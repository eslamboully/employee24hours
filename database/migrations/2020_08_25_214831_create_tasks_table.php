<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->integer('price')->nullable();
            $table->string('deadline')->nullable();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->on('companies')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')
                ->on('jobs')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                ->on('employees')
                ->references('id')
                ->onDelete('cascade');

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
        Schema::dropIfExists('tasks');
    }
}
