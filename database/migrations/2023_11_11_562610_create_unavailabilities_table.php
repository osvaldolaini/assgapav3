<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnavailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unavailabilities', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->unsignedBigInteger('ambience_id')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('title')->nullable();
            /*Alteração */
            $table->text('updated_because')->nullable();
            /*Excluido */
            $table->timestamp('deleted_at')->nullable();
            $table->text('deleted_because')->nullable();
            $table->string('deleted_by')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();

            /*RELACIONAMENTO*/
            $table->foreign('ambience_id')->references('id')->on('ambiences')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unavailabilities');
    }
}
