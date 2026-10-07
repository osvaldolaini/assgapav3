<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller_id')
                ->constrained('partners')
                ->cascadeOnDelete();

            $table->foreignId('bill_id')->nullable()->constrained();
            $table->date('date');

            $table->decimal('value', 10, 2);

            $table->string('form_payment')->nullable();

            $table->text('observation')->nullable();

            // $table->foreignId('created_by')
            //     ->nullable()
            //     ->constrained('users')
            //     ->nullOnDelete();

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

    public function down(): void
    {
        Schema::dropIfExists('seller_payments');
    }
};
