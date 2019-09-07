@extends('layouts.app')

@section('content')
	<test-deck-component
		:deck = " {{ json_encode($deck) }} "
	>
	</test-deck-component>


@endsection