<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteTableMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus',function(Blueprint $table){
            $table->increments('id');
            $table->string('uuid');
            $table->string('slug');
            $table->string('name');
            $table->string('icon');
            $table->string('href');
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('is_parent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
