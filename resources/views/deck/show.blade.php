@extends('layouts.app')

@section('content')
    <div class="content vh-100 d-flex justify-content-center w-100">
        <div class="title align-self-center d-flex flex-column align-items-center">
            <h1 class="display-1"> {{ $deck->title }} </h1> 
            <a href=" {{ route('decktest.start', $deck) }} " class="btn btn-outline-primary btn-block "> Start test </a>
        </div>
    </div>
    <cards-in-deck
        :deck=" {{ json_encode($deck) }} "
        :cardtypes=" {{ json_encode($cardtypes) }} "
    >
    </cards-in-deck>
    <new-card-fixed-button
        :cardtypes= " {{ json_encode($cardtypes) }} "
        :deck_id=" {{ $deck->id }} "
    >
    </new-card-fixed-button>
    <new-card-modal
        :deck_id=" {{ $deck->id }} "
    >
    </new-card-modal>

@endsection