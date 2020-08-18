<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('skill_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('skill_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->unique(['skill_id', 'locale']);
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_translations');
    }
}
