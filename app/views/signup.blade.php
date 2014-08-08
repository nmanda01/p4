@extends('layouts.main')
<h1>iContacts</h1>
<h2>Sign up</h3>

@section('content')
	{{ Form::open(array('url' => '/signup')) }}

  		<input type="text" name ="name" placeholder="Username" />
  		<input type="text" name ="email" placeholder="Email" />
		<input type="password" name ="password" placeholder="Password" />
		<input type="submit" value="Sign Up" />

	

	{{ Form::close() }}

