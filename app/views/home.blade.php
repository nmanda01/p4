@extends('layouts.main')

@section('content')
	<h1>iContacts</h1>
	<h2>{{Auth::user()->name}}'s Contacts </h2>

	<p>(<small><a href="{{ URL::route('new') }}">new contact</a></small>)</p></br>
 
 	@foreach ($errors->all() as $error)
		<p class="error"> 
			{{ $error}}  
		</p>
	@endforeach                           
                            
		<ul>
               @foreach ($contacts as $contact)
                     <li>
                       
                              
                           {{ Form::open() }}   
                               
                           	<input type="hidden" name="id" value="{{$contact->id}}" />
                           	</br>
                            <input type="text" name="contactName" placeholder="Name" value="{{$contact->name}}" /> (<small><a href="{{ URL::route('delete', $contact->id) }}" >delete</a></small>)
                            </br>
                            <input type="text" name="contactEmail" placeholder="Email" value="{{$contact->emailAddress}}" />
                            </br>
                            <input type="text" name="contactPhone" placeholder="Phone Number" value="{{$contact->phoneNumber}}" />
                            </br>
                            </br>
                            <input type="submit" value="Save" /> </br></br>
                               
                           {{ Form::close() }}    
                               
                     </li>          
               @endforeach
        
        </ul> 
       
       (<small><a href="/logout">Logout</a></small>)

@stop