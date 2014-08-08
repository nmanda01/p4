@extends('layouts.main')


@section('content')

<h1>iContacts</h1>

	@foreach ($errors->all() as $error)
		<p class="error" >{{ $error }}</p>
	@endforeach
	
	
	{{ Form::open()  }}
		<input type="text" name ="username" placeholder="Username" />
		<input type="password" name ="password" placeholder="Password" />
		<input type="submit" value="Log In" /> </br></br>
		
		<a href="/signup">Sign Up</a>

	
	{{ Form::close() }}
@stop