@extends('layouts.app')

@section('content')
	<div class="jumbotron ">
		<h1 class="display-4">Hello, Welcome to Yezid World</h1>
		<p>You can send me a message below</p>
	</div>
	{!! Form::open(['action'=>'MessageController@store', 'method'=>'POST','enctype'=>'multipart/form-data'])!!}
	<div class="form-group col-7">
		
			{{form::label('name','Name')}}
			{{form::text('name','',['class'=>'form-control', 'placeholder'=>'Name'])}}

			{{form::label('email','Email')}}
			{{form::text('email','',['class'=>'form-control','placeholder'=>'Email'])}}

			{{form::label('subject','Subject')}}
			{{form::text('subject','',['class'=>'form-control','placeholder'=>'Subject'])}}

			{{form::label('message','Message')}}
			{{form::textarea('message','',['class'=>'form-control','placeholder'=>'Please enter your message'])}}
			<br>
			{{form::file('doc')}}

			<hr>
			{{form::submit('submit',['class'=>'btn btn-primary'])}}
	</div>
	{!! Form::close()!!}



@endsection




