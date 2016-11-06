<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('orders', function($table){
    		$table->increments('id');
    		$table->integer('user_id');
    		$table->integer('client_id')->default(0);
    		$table->string('invoiceNumber')->nullable();
    		$table->string('economicInvoiceNumber')->nullable();
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
        Schema::drop('orders');
    }
}
