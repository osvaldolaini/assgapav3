<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('status')->nullable();
            $table->date('paid_in')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();

            $table->foreignId('cost_center_id')->nullable()->constrained();

            $table->string('type')->nullable();
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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashiers');
    }
}
