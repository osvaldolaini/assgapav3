<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->boolean('active')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->string('form_payment')->nullable();
            $table->date('installment_maturity_date')->nullable();
            $table->unsignedBigInteger('received_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            /*Alteração */
            $table->text('updated_because')->nullable();
            /*Excluido */
            $table->timestamp('deleted_at')->nullable();
            $table->text('deleted_because')->nullable();
            $table->string('deleted_by')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by', 50)->nullable();
            $table->string('created_by', 50)->nullable();
            /*RELACIONAMENTO*/
            $table->foreign('received_id')->references('id')->on('receiveds')->onDelete('SET NULL');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');

            /*Observação inserido em 2025_10_24*/
            $table->text('obs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installments');
    }
}
