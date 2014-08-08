@extends('layouts.main')

@section('content')
	<h1>iContacts</h1>
	<h2>{{Auth::user()->name}}'s Contacts </h2>
	<h3> Create A New Contact </h3>
	
	@foreach ($errors->all() as $error)
		<p class="error"> 
			{{ $error}}  
		</p>
	@endforeach
	
			{{ Form::open() }} 
			<input type="text" name="contactName" placeholder="Name" value="{{isset($contactName)? $contactName:''}}" />
                            </br>
                            <input type="text" name="contactEmail" placeholder="Email"  />
                            </br>
                            <input type="text" name="contactPhone" placeholder="Phone Number"   />
                            </br>
                            </br>
                            <input type="submit" value="Save" /> </br>
                            
                {{ Form::close() }}   
                            

@stop