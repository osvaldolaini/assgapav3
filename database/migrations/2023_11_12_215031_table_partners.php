<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
        /*RELACIONAMENTO*/
        $table->foreign('responsible')->references('id')->on('partners')->onDelete('SET NULL');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            /*RELACIONAMENTO*/
            $table->dropForeign('partners_id_foreign');
        });
    }
}
