<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('addresses', function($table){
    		$table->increments('id');
    		$table->integer('user_id')->nullable();
    		$table->integer('client_id');
    		$table->string('name')->nullable();
    		$table->string('address');
    		$table->string('address2')->nullable();
    		$table->integer('zip');
    		$table->string('city');
    		$table->string('country')->default('denmark');
    		$table->string('phone')->nullable();
    		$table->string('email')->nullable();
    		$table->text('notes')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
