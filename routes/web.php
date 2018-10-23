<?php

Auth::routes(['verify' => true]);

Route::prefix('/cliente')->name('client.')->middleware('verified')->group(function() {
	Route::get('', 'HomeController@index')->name('home');
});

Route::get('/', function () {
    return view('pages.welcome.index');
});

Route::get('/quem-somos', function () {
    return view('pages.about.index');
});

Route::get('/contato', function () {
    return view('pages.contact.index');
});

Route::get('/planos', function () {
    return view('pages.plans.index');
});

Route::get('/procurar', 'SpacesController@search');
Route::get('/agendar', 'SpacesController@confirm');

Route::post('/reservar', 'SpacesController@pay')->middleware('auth');
