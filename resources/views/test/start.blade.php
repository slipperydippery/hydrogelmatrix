@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-12">
			<h1>Start test  {{ $deck->name }} </h1>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="hydrocard flip-vertical-right">
				<div class="front face">This is a question</div>
				<div class="back face">This is an answer</div>
				
				
			</div>
		</div>
	</div>


@endsection