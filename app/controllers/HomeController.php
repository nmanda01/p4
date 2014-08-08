<?php

class HomeController extends BaseController 

{

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	
	//When home page is reached after login, an array of contacts that belong to said user is generated for the Home View. 


	public function getIndex()
	{
				
		$contacts = Auth::user()->contacts;
		
		return View::make('home', array(
				'contacts' => $contacts
				)
			);
	}
		
		
	//How a contact is modified and saved from form.  Name needs to have at least one character and is required.  Redirects to home page if invalid.	
		
	public function postSave()
	{
		$validator = Validator::make(array(
				'contactName' => Input::get('contactName'),
				'contactEmail' => Input::get('contactEmail'),
				'contactPhone' => Input::get('contactPhone')),
		
				array(
						'contactName' => 'required|min:1',
						'contactEmail' => 'email',
						'contactPhone' => 'max:30'
				)
		);
		
		if ($validator->fails()){
			return Redirect::route('home')->withErrors($validator)->withInput();
		}
		
		$contact = Contact::findOrFail(Input::get('id'));
		$contact->name = Input::get('contactName');
		$contact->phoneNumber = Input::get('contactPhone');
		$contact->emailAddress = Input::get('contactEmail');
		$contact->save();		
           
		return Redirect::route('home'); 

	}
	
	//When clicking on option for new contact, directs you to "new" view for a form. 
	
	public function getNew()
	{		
		//$newCon = new Contact();					
		return View::make('new');
		
	} 
	
	
	//How a new contact from the new View is processed. Same requirements as when modifying a contact. 
	
	public function postNew() 
	{
		$validator = Validator::make(array(
			'contactName' => Input::get('contactName'),
			'contactEmail' => Input::get('contactEmail'),
			'contactPhone' => Input::get('contactPhone')),
				
			array(
			'contactName' => 'required|min:1',
			'contactEmail' => 'email',
			'contactPhone' => 'max:30'
				)
		  );
		
		if ($validator->fails()){
			return Redirect::route('new')->withInput()->withErrors($validator);
		}
		
		
		$contact = new Contact();
		
		$contact->name = Input::get('contactName');
		$contact->emailAddress = Input::get('contactEmail');
		$contact->phoneNumber = Input::get('contactPhone');
		
		$contact->user_id = Auth::user()->id;

		$contact->save();
		
		return Redirect::route('home'); 

	
	//Method to delete a contact.  The URL will include the contact's unique ID, so this variable is used to identify the contact in the model, and then it's deleted from database. 
	}
	
	
	public function getDelete($id)
	{
	
		$contact = Contact::findOrFail($id);
		$contact->delete();
	
		return Redirect::route('home');
	
	}
	
		
}


