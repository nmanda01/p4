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

Route::get('/', array('as' => 'home' , 'uses' => 'HomeController@getIndex'))->before('auth');

Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('login', 'AuthController@postLogin')->before('csrf');



	


Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

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

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

Route::post('/', array('uses' => 'HomeController@postSave'))->before('csrf');


Route::get('/new', array('as' => 'new' , 'uses' => 'HomeController@getNew'))->before('auth');

Route::post('/new', array('uses' => 'HomeController@postNew'))->before('csrf');

Route::get('/delete/{id}', array('as' => 'delete' , 'uses' => 'HomeController@getDelete'))->before('auth');


