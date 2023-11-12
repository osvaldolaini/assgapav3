<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbienceAmbienceTenantPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambience_ambience_tenant_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ambience_id')->nullable();
            $table->unsignedBigInteger('ambienceTenant_id')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->decimal('deposit', $precision = 10, $scale = 2)->nullable();
            $table->decimal('dressing_room', $precision = 10, $scale = 2)->nullable();
            $table->decimal('lighting', $precision = 10, $scale = 2)->nullable();
            $table->timestamps();
            /*RELACIONAMENTO*/
            $table->foreign('ambienceTenant_id')->references('id')->on('ambience_tenants')->onDelete('CASCADE');
            $table->foreign('ambience_id')->references('id')->on('ambiences')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambience_ambience_tenant_pivot');
    }
}
