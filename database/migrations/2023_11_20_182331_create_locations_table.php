<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('ambience')->nullable();

            $table->foreignId('ambience_id')->nullable()->constrained();

            $table->string('partner')->nullable();
            $table->foreignId('partner_id')->nullable()->constrained();
            $table->string('ambience_tenant')->nullable();
            $table->foreignId('ambience_tenant_id')->nullable()->constrained();
            $table->date('location_date')->nullable();
            $table->time('location_hour_start')->nullable();
            $table->time('location_hour_end')->nullable();

            $table->string('event_type')->nullable();
            $table->string('event_benefited')->nullable();
            $table->decimal('value', $precision = 10, $scale = 2)->nullable();
            $table->decimal('deposit', $precision = 10, $scale = 2)->nullable();

            $table->boolean('lighting')->nullable();
            $table->boolean('dressing_room')->nullable();
            $table->boolean('security')->nullable();
            $table->boolean('janitor')->nullable();

            $table->unsignedBigInteger('indication_id')->nullable()->nullable();
            $table->foreignId('reason_event_id')->nullable()->constrained();

            $table->decimal('value_extra', $precision = 10, $scale = 2)->nullable();
            $table->string('loc_time')->nullable();

            /*Alteração */
            $table->text('updated_because')->nullable();
            /*Excluido */
            $table->timestamp('deleted_at')->nullable();
            $table->text('deleted_because')->nullable();
            $table->string('deleted_by')->nullable();
            /*Padrão */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();

            /*RELACIONAMENTO*/
            $table->foreign('indication_id')->references('id')->on('partners')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
