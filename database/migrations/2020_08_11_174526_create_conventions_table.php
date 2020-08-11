<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conventions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('agreement_id')->unsigned();
            $table->foreign('agreement_id')->references('id')->on('agreements')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('convention_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convention_id')->unsigned();
            $table->string('locale')->index();
            $table->text('main_items');
            $table->text('sub_items');
            $table->unique(['convention_id', 'locale']);
            $table->foreign('convention_id')->references('id')->on('conventions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conventions');
        Schema::dropIfExists('convention_translations');
    }
}
