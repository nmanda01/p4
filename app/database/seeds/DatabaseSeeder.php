<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		
		$this->call('ContactsTableSeeder');
	}

}


class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        
        $users = array (
        		 	array (
        		 		'name' => 'Thom' ,
        		 		'password' => Hash::make('Thom'),
        		 		'email' => 'tyorke@radiohead.com'
        		 		),
        		 		
        		 		
        		 		
        		 	);

		DB::table('users')->insert($users);
    }
}

class ContactsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('contacts')->delete();
        
        $contacts = array (
        		 	
        		 		array (
        		 			'user_id' => 3,
        		 			'name' => 'Jonny' ,
        		 			'phoneNumber' => 2432144444,
        		 			'emailAddress' => 'jgreenwood@radiohead.com'
        		 			),
        		 			
        		 		array (
        		 			'user_id' => 3,
        		 			'name' => 'Colin',
        		 			'phoneNumber' => 9244586167,
        		 			'emailAddress' => 'cgreenwood@radiohead.com'
        		 			),
        		 			
        		 		array (
        		 			'user_id' => 3,
        		 			'name' => 'Ed',
        		 			'phoneNumber' => 1756182912,
        		 			'emailAddress' => 'eobrian@radiohead.com'
        		 			),
        		 			
        		 		array (
        		 			'user_id' => 3,
        		 			'name' => 'Phil',
        		 			'phoneNumber' => 7730343987,
        		 			'emailAddress' => 'pselway@radiohead.com'
        		 			)
        		 		
        		 		
        		 	) 	;

		DB::table('contacts')->insert($contacts);
    }
}
