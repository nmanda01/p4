<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('password');
			$table->string('email');
			$table->timestamps();
			$table->boolean('remember_token');
			
			
		
		}); 
		
			Schema::create('contacts' , function(Blueprint $table) {
			$table ->increments('id');
			$table ->integer('user_id');
			$table ->string('name');
			$table ->string('phoneNumber');
			$table ->string('emailAddress');
			$table ->timestamps(); 
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
				Schema::drop('users') ;
				Schema::drop('contacts');
				

	}

}
