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
		
		//Creates table for users with unique identifier, and three fields that are self-explanatory.  
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('password');
			$table->string('email');
			$table->timestamps();
			
			$table->boolean('remember_token');
			
			
		
		}); 
		
			//Creates a contact manager that has a unique id, an id that links it to the user who owns the contact, and then three fields - name, email, and phone number
		
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
	public function down() //Obviously here we just drop the two tables
	
	{
				Schema::drop('users') ;
				Schema::drop('contacts');
				

	}

}
