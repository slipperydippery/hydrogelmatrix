@extends('layouts.app')

@section('content')
    <div class="content vh-100 d-flex justify-content-center w-100">
        <div class="title align-self-center d-flex flex-column align-items-center">
            <h1 class="display-1"> {{ $deck->title }} </h1> 
            <a href=" {{ route('decktest.start', $deck) }} " class="btn btn-outline-primary btn-block "> Start test </a>
        </div>
    </div>
    <div class="row no-gutters">
        @foreach ($cards as $card)
            <div class="col-4">
                <a href=" {{ route('card.show', $card) }} ">
                    <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=<?= $card->front ?>" alt="" class="img-fluid">
                </a>
            </div>
        @endforeach
    </div>
    <new-card-fixed-button
        :cardtypes= " {{ json_encode($cardtypes) }} "
    >
    </new-card-fixed-button>
    <new-qa-card-modal
        :deckid=" {{ $deck->id }} "
    >
    </new-qa-card-modal>



@endsection