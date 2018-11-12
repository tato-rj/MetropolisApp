<?php

Auth::routes(['verify' => true]);

Route::prefix('/cliente')->name('client.')->middleware(['auth', 'verified'])->group(function() {
	Route::get('', 'HomeController@index')->name('home');

	Route::prefix('agenda')->name('events.')->group(function() {
		Route::get('', 'EventsController@index')->name('index');
		Route::post('', 'EventsController@store')->name('store');
	});
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

Route::prefix('eventos')->name('events.')->group(function() {
	Route::get('/buscar', 'EventsController@search')->name('search');
	Route::post('/reservar', 'EventsController@pay')->name('pay')->middleware('auth');
});

Route::get('/planos/{plan}/assinar', 'PlanController@subscribe')->middleware('auth');
