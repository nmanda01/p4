<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Home route is self-explanatory, and auth filter is used so that you have to be logged in to use application

Route::get('/', array('as' => 'home' , 'uses' => 'HomeController@getIndex'))->before('auth');

//login page accessible if you're not logged in.  Submitting login calls AuthController

Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('login', 'AuthController@postLogin')->before('csrf');



	
//Sign up page.  

Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

//Processing sign up form to create new user

Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->name    = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            $user->email    = Input::get('email');

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            
            Auth::login($user);

            return Redirect::to('/')->with('flash_message', 'Welcome to iContacts!');

        }
    )
);

//logout route

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

//Modifting a contact calls method in Home Controller

Route::post('/', array('uses' => 'HomeController@postSave'))->before('csrf');

//Route to create a new contact

Route::get('/new', array('as' => 'new' , 'uses' => 'HomeController@getNew'))->before('auth');

//Route to process new contact and add to database.  Both of these routes use HomeController

Route::post('/new', array('uses' => 'HomeController@postNew'))->before('csrf');

//Delete route processes the contact's unique ID in the URL and then calls HomeController method to process deletion.

Route::get('/delete/{id}', array('as' => 'delete' , 'uses' => 'HomeController@getDelete'))->before('auth');


