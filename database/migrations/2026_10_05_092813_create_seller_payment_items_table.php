<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_payment_items', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->nullable();

            $table->foreignId('seller_payment_id')
                ->constrained('seller_payments')
                ->cascadeOnDelete();

            $table->string('item_type');

            $table->unsignedBigInteger('item_id');

            $table->decimal('value', 10, 2);

            $table->timestamps();

            $table->index(['item_type', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_payment_items');
    }
};
