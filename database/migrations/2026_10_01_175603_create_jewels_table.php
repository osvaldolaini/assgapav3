<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jewels', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->date('paid_in')->nullable();
            $table->date('start_suspension')->nullable();
            $table->date('end_suspension')->nullable();
            $table->boolean('status')->nullable();
            $table->foreignId('received_id')->nullable()->constrained();
            $table->boolean('received')->nullable();
            $table->string('form_payment')->nullable();

            $table->boolean('active')->nullable();
            $table->string('partner')->nullable();
            $table->foreignId('partner_id')->nullable()->constrained();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->text('obs')->nullable();
            /*RELACIONAMENTO*/

            $table->unsignedBigInteger('indication_id')->nullable()->nullable();
            $table->foreign('indication_id')->references('id')->on('partners')->onDelete('NO ACTION');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jewels');
    }
};
