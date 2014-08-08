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

	public function getIndex()
	{
				
		$contacts = Auth::user()->contacts;
		
		return View::make('home', array(
				'contacts' => $contacts
				)
			);
	}
		
		
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
	
	
	public function getNew()
	{		
		//$newCon = new Contact();					
		return View::make('new');
		
	} 
	
	
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

	
	
	}
	
	
	public function getDelete($id)
	{
	
		$contact = Contact::findOrFail($id);
		$contact->delete();
	
		return Redirect::route('home');
	
	}
	
		
}


