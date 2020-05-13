<?php

app()->singleton(GateContract::class, function ($app) {
    return new Gate($app, function () use ($app) {
        return call_user_func($app['auth']->userResolver());
    });
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Route::resource('deck', 'DeckController');
Route::resource('test', 'TestController');

Route::get('/deck/{deck}/test', 'DeckTestController@start')->name('decktest.start');
