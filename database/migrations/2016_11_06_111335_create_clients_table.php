<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('clients', function($table){
    		$table->increments('id');
    		$table->integer('user_id');
			$table->string('type')->default('private');
    		$table->string('name');
    		$table->string('address')->nullable();
    		$table->string('address2')->nullable();
    		$table->integer('zip')->nullable();
    		$table->string('city')->nullable();
    		$table->string('country')->default('denmark');
    		$table->string('cvr')->nullable();
    		$table->string('contactperson')->nullable();
    		$table->string('phone')->nullable();
    		$table->string('email')->nullable();
    		$table->text('notes')->nullable();
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
        Schema::drop('clients');
    }
}
