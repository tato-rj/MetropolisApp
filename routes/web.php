<?php

// For development only
App\Http\Controllers\Auth\GateController::auth();

Auth::routes(['verify' => true]);

Route::prefix('cliente')->name('client.')->middleware(['auth', 'verified'])->group(function() {

	Route::get('', 'HomeController@index')->name('home');

	Route::prefix('agenda')->name('events.')->group(function() {

		Route::get('', 'UsersController@schedule')->name('index');
	
		Route::post('/ajax', 'EventsController@ajax')->name('ajax');

		Route::post('/convidar', 'EventsController@invite')->name('invite');

		Route::get('/pagamento', 'EventsController@payment')->name('payment');

		Route::post('/comprar', 'EventsController@purchase')->name('purchase');

		Route::post('/{event}', 'EventsController@update')->name('update');

		Route::post('/{event}/status', 'EventsController@status')->name('status');
	
		Route::post('/{event}/emails', 'EventsController@updateEmails')->name('update.emails');

	});

	Route::prefix('pagamentos')->name('payments.')->group(function() {

		Route::get('', 'PaymentsController@index')->name('index');

		Route::get('load-fields', 'PaymentsController@loadFields')->name('load-fields');

	});

	Route::prefix('cadastro')->name('profile.')->group(function() {

		Route::get('', 'UsersController@profile')->name('show');

		Route::post('', 'UsersController@update')->name('update');

		Route::post('/password', 'UsersController@password')->name('update.password');

		Route::post('/creditCard', 'UsersController@creditCard')->name('update.creditCard');

		Route::post('/creditCard/remove', 'UsersController@removeCard')->name('remove.creditCard');

	});

	Route::prefix('suporte')->name('support.')->group(function() {

		Route::get('', 'UsersController@support')->name('show');

	});
});

Route::get('/', function () {
    return view('pages.welcome.index');
})->name('welcome');

Route::get('/quem-somos', function () {
    return view('pages.about.index');
});

Route::get('/consultoria', function () {
    return view('pages.consulting.index');
});

Route::get('/contato', function () {
    return view('pages.contact.index');
});

Route::prefix('planos')->name('plan.')->group(function() {

	Route::get('', 'PlansController@index')->name('index');

	Route::middleware(['auth', 'verified'])->group(function() {

		Route::get('confirmar', 'PlansController@confirm')->name('confirm');

		Route::get('pagamento', 'PlansController@payment')->name('payment');

		Route::post('assinar', 'PlansController@subscribe')->name('subscribe');
		
		Route::post('/{event}/status', 'PlansController@status')->name('status');
	
	});

});

Route::prefix('workshop')->name('workshops.')->group(function() {

	Route::get('', 'WorkshopsController@index')->name('index');

	Route::get('/{workshop}', 'WorkshopsController@show')->name('show');

	Route::prefix('/{workshop}')->middleware(['auth', 'verified'])->group(function() {

		Route::get('/ajax', 'WorkshopsController@ajax')->name('ajax');
		
		Route::get('/pagamento', 'WorkshopsController@payment')->name('payment');

		Route::post('', 'WorkshopsController@purchase')->name('purchase');

	});

});

Route::prefix('eventos')->name('events.')->group(function() {

	Route::get('/buscar', 'EventsController@search')->name('search');

});

Route::get('/mail/confirm', function() {
	return new \App\Mail\ConfirmPlan(auth()->user());
});