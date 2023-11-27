<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->decimal('dressing_room', $precision = 10, $scale = 2)->nullable();
            $table->decimal('lighting', $precision = 10, $scale = 2)->nullable();
            $table->decimal('janitor', $precision = 10, $scale = 2)->nullable();
            $table->decimal('security', $precision = 10, $scale = 2)->nullable();
            $table->decimal('inflatable', $precision = 10, $scale = 2)->nullable();
            $table->decimal('brigade', $precision = 10, $scale = 2)->nullable();

            $table->integer('qtd_dressing_room')->nullable();
            $table->integer('qtd_lighting')->nullable();
            $table->integer('qtd_janitor')->nullable();
            $table->integer('qtd_security')->nullable();
            $table->integer('qtd_inflatable')->nullable();
            $table->integer('qtd_brigade')->nullable();

            $table->timestamps();
            /*RELACIONAMENTO*/
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_extras');
    }
}
