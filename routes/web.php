<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('deck', 'DeckController');

Route::get('/deck/{deck}/test', 'DeckTestController@start')->name('decktest.start');