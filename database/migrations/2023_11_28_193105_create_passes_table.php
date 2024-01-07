<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('partner')->nullable();
            $table->string('obs')->nullable();
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('validity')->nullable();
            $table->string('color')->nullable();
            $table->date('validity_of_card')->nullable();
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passes');
    }
}
