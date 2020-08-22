<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->integer('status')->default(0);
            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create('mission_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mission_id')->unsigned();
            $table->string('locale')->index();
            $table->text('mission')->nullable();
            $table->unique(['mission_id', 'locale']);
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
        Schema::dropIfExists('mission_translations');
    }
}
