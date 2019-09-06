@extends('layouts.app')

@section('content')
    <div class="content vh-100 d-flex justify-content-center w-100">
        <div class="title align-self-center ">
            <h1 class="display-1">Hydrogel Matrix!</h1>
        </div>
    </div>
    <div class="row no-gutters">
        @foreach ($decks as $deck)
            <div class="col-4">
                <a href=" {{ route('deck.show', $deck) }} ">
                    <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=<?= $deck->title ?>" alt="" class="img-fluid">
                </a>
            </div>
        @endforeach
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
        <div class="col-4">
            <a href="#">
                <img src="https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=deck" alt="" class="img-fluid">
            </a>
        </div>
    </div>

    <new-deck-modal></new-deck-modal>

@endsection