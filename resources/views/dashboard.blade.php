@extends('layouts.app')

@section('content')
    <div class="content vh-100 d-flex justify-content-center w-100 bg-white">
        <div class="title align-self-center ">
            <h1 class="display-1">Hydrogel Matrix!</h1>
        </div>
    </div>

    <decks-by-user
        :decks = " {{ json_encode($decks) }} "
    >
    </decks-by-user>

    <new-deck-modal>
    </new-deck-modal>

@endsection