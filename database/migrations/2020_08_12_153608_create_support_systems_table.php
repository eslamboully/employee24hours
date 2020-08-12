<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_systems', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->default('default.png');
            $table->timestamps();
        });

        Schema::create('support_system_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('support_system_id')->unsigned();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('description');
            $table->unique(['support_system_id', 'locale']);
            $table->foreign('support_system_id')->references('id')->on('support_systems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_systems');
        Schema::dropIfExists('support_system_translations');
    }
}
