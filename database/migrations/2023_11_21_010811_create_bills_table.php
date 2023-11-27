<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('title')->nullable();
            $table->date('paid_in')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->foreignId('cost_center_id')->nullable()->constrained();
            $table->string('creditor')->nullable();
            $table->string('creditor_document')->nullable();
            $table->unsignedBigInteger('creditor_id')->nullable();
            $table->string('type')->nullable();

            $table->text('obs')->nullable();
            /*Alteração */
            $table->text('updated_because')->nullable();
            /*Excluido */
            $table->date('deleted_at')->nullable();
            $table->text('deleted_because')->nullable();
            $table->string('deleted_by')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();

            /*RELACIONAMENTO*/
            $table->foreign('creditor_id')->references('id')->on('partners')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
