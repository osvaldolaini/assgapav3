<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_pays', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('bracelets')->nullable();
            $table->boolean('active')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->date('paid_in')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('received_id')->nullable();
            $table->string('form_payment')->nullable();
            $table->string('type')->nullable();
            /*Alteração */
            $table->text('updated_because')->nullable();
            /*Excluido */
            $table->date('deleted_at')->nullable();
            $table->text('deleted_because')->nullable();
            $table->string('deleted_by')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by', 50)->nullable();
            $table->string('created_by', 50)->nullable();
            /*RELACIONAMENTO*/
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('SET NULL');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');
            $table->foreign('received_id')->references('id')->on('receiveds')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_pays');
    }
}
