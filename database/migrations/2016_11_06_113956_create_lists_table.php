<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('lists', function($table){
    		$table->increments('id');
    		$table->integer('user_id');
    		$table->integer('department_id')->nullable();
    		$table->string('name');
    		$table->text('notes');
    		$table->integer('due')->default(0);
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lists');
    }
}
