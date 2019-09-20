@extends('layouts.clean')

@section('content')
	<test-deck-component
		:deck = " {{ json_encode($deck) }} "
	>
	</test-deck-component>


@endsection

@section('additional-scripts')

@endsection