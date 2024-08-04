<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_permanent')->nullable()->after('numero_etudiant');
            $table->string('numero_table_bac')->nullable()->after('id_permanent');
            $table->string('code_ep')->nullable()->after('numero_table_bac');
            $table->string('emargement')->nullable()->after('code_ep');
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
            //
        });
    }
}
