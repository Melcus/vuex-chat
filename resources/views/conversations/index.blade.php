@extends('layouts.app')

@section('content')
	<div class="container">


			<conversations-dashboard
					:id="{{ isset($conversation) ? $conversation->id : json_encode(null)}}"
			></conversations-dashboard>
		
	</div>
@endsection
