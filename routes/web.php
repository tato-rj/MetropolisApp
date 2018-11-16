<?php

Auth::routes(['verify' => true]);

Route::prefix('cliente')->name('client.')->middleware(['auth', 'verified'])->group(function() {
	Route::get('', 'HomeController@index')->name('home');

	Route::prefix('agenda')->name('events.')->group(function() {
		Route::get('', 'EventsController@index')->name('index');
	
		Route::post('/ajax', 'EventsController@ajax')->name('ajax');

		Route::post('/convidar', 'EventsController@invite')->name('invite');

		Route::post('/{event}', 'EventsController@update')->name('update');
	
		Route::post('/{event}/emails', 'EventsController@updateEmails')->name('update.emails');
	
		Route::post('', 'EventsController@store')->name('store');
	});

	Route::prefix('plano')->name('plan.')->group(function() {
		Route::get('confirmar', 'PlansController@confirm')->name('confirm');
		
		Route::post('assinar', 'PlansController@subscribe')->name('subscribe');
	});
});

Route::get('/', function () {
    return view('pages.welcome.index');
})->name('welcome');

Route::get('/quem-somos', function () {
    return view('pages.about.index');
});

Route::get('/contato', function () {
    return view('pages.contact.index');
});

Route::get('/planos', function () {
    return view('pages.plans.show.index');
});

Route::prefix('eventos')->name('events.')->group(function() {
	Route::get('/buscar', 'EventsController@search')->name('search');
});

Route::get('/mail/confirm', function() {
	return new \App\Mail\ConfirmPlan(auth()->user());
});