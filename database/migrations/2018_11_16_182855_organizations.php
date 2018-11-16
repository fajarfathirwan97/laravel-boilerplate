<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Organizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations',function(Blueprint $table){
            $table->string('uuid');
            $table->string('email');
            $table->string('phone');
            $table->string('website');
            $table->string('logo');
        });
        Schema::table('organizations',function(Blueprint $table){
            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
            
    }
}
