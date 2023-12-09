<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->nullable();
            $table->string('dashboard')->nullable();
            $table->foreignId('user_groups_id')->nullable();
            $table->string('nick')->nullable();
            $table->string('updated_by',50)->nullable()->after('updated_at');
            $table->string('created_by',50)->nullable()->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            /*RELACIONAMENTO*/
            $table->dropForeign('user_groups_id_foreign');
            $table->dropColumn(array('active','group_id','image','update_by','nick'));
        });
    }
}
