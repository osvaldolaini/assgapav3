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
        Schema::create('monthly_payments', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->date('paid_in')->nullable();
            $table->foreignId('partner_id')->nullable()->constrained();
            $table->date('start_suspension')->nullable();
            $table->date('end_suspension')->nullable();
            $table->boolean('status')->nullable();
            $table->string('ref')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->foreignId('received_id')->nullable()->constrained();
            $table->boolean('received')->nullable();
            $table->string('form_payment')->nullable();
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_payments');
    }
};
