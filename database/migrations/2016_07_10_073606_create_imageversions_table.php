<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('imageversions', function($table){
    		$table->increments('id');
    		$table->integer('image_id');
    		$table->integer('width');
    		$table->integer('height');
    		$table->string('filename');
    		$table->integer('size');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imageversions');
    }
}
