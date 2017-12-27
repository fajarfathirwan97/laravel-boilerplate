<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('uuid');
            $table->string('username');
        });
        Schema::table('roles',function(Blueprint $table){
            $table->string('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('uuid');
            $table->dropColumn('username');
        });
        Schema::table('roles',function(Blueprint $table){
            $table->dropColumn('uuid');
        });
    }
}
