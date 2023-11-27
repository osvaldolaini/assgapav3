<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiveds', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->boolean('active')->nullable();
            $table->date('paid_in')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->string('partner')->nullable();
            $table->unsignedBigInteger('ambience_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('ambience_tenant_id')->nullable();
            $table->string('form_payment')->nullable();

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
            $table->foreign('ambience_tenant_id')->references('id')->on('ambience_tenants')->onDelete('SET NULL');
            $table->foreign('ambience_id')->references('id')->on('ambiences')->onDelete('SET NULL');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('SET NULL');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiveds');
    }
}
