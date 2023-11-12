<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiences', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('capacity')->nullable();
            $table->integer('cashback')->nullable();
            $table->string('time_week')->nullable();
            $table->string('time_weekend')->nullable();
            $table->mediumText('obs')->nullable();
            $table->longText('contract')->nullable();
            $table->longText('term')->nullable();
            $table->longText('term_return')->nullable();
            $table->boolean('multiple')->nullable();
            $table->boolean('need')->nullable();

            $table->unsignedBigInteger('ambience_category')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();

            /*RELACIONAMENTOS*/
            $table->foreign('ambience_category')->references('id')->on('ambience_categories')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambiences');
    }
}
