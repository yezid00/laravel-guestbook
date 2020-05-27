@extends('layouts.app')

@section('content')
	<h2>Messages</h2>

	@if(count($messages) > 0)
			<div class="table">
				<table>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th colspan="3">Message</th>
						<th>File</th>
						<th>Date</th>
						<th></th>

					</tr>
					@foreach($messages as $message)
						<tr>
							<td>{{$message->id}}</td>
							<td>{{$message->name}}</td>
							<td>{{$message->email}}</td>
							<td>{{$message->subject}}</td>
							<td colspan="3">{{$message->message}}</td>
							<td>{{$message->doc}}</td>
							<td>{{ $message->created_at->diffForHumans()}}</td>
							<td> 
									{!! Form::open(['action'=>['MessageController@update',$message->id],'method'=>'PUT'])!!}
										{{ form::submit('Update',['class'=>'btn btn-primary btn-xs'])}}
									{!! form::close()!!}
								{!! Form::open(['action'=>['MessageController@destroy',$message->id],'method'=>'DELETE'])!!}
									{{form::submit('Delete', ['class'=>'btn btn-danger btn-xs'])}}
								{!! form::close()!!}
								
								
							</td>
						</tr>

					@endforeach
			</table>

			</div>
			

	@endif

@endsection