<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('responsible')->nullable();
            $table->string('kinship')->nullable();
            $table->string('image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('obs')->nullable();
            $table->string('pf_pj')->nullable();
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->integer('saram')->nullable();
            $table->string('phone_first',50)->nullable();
            $table->string('phone_second',50)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('email_birthday')->nullable();
            $table->boolean('send_email_barthday')->nullable();
            $table->text('needs')->nullable();
            $table->date('access_pool')->nullable();
            $table->date('print_date')->nullable();
            $table->date('validity_of_card')->nullable();
            $table->date('grace_period')->nullable();
            $table->date('registration_at')->nullable();
            $table->boolean('discount')->nullable();

            $table->unsignedBigInteger('partner_category')->nullable();
            $table->string('partner_category_master')->nullable();

            $table->string('company')->nullable();

            /*Padrão */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();

            /*RELACIONAMENTOS*/
            $table->foreign('partner_category')->references('id')->on('partner_categories')->onDelete('SET NULL');
            //$table->foreign('partners')->references('id')->on('responsible')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
