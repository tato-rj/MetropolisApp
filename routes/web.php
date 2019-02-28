<?php

// For development only
App\Http\Controllers\Auth\GateController::auth();

Auth::routes(['verify' => true]);

Route::prefix('cliente')->name('client.')->middleware(['auth', 'verified'])->group(function() {

	Route::get('', 'HomeController@index')->name('home');

	Route::prefix('agenda')->name('events.')->group(function() {

		Route::get('', 'UsersController@schedule')->name('index');

		Route::post('/convidar', 'EventsController@invite')->name('invite');

		Route::get('/pagamento', 'EventsController@payment')->name('payment');

		Route::post('/comprar', 'EventsController@purchase')->name('purchase');

		Route::post('/{event}', 'EventsController@update')->name('update');

		// Route::post('/{event}/status', 'EventsController@status')->name('status');
	
		Route::post('/{event}/emails', 'EventsController@updateEmails')->name('update.emails');

	});

	Route::prefix('pagamentos')->name('payments.')->group(function() {

		Route::get('', 'PaymentsController@index')->name('index');

		Route::get('load-fields', 'PaymentsController@loadFields')->name('load-fields');

		Route::get('completar', 'PaymentsController@create')->name('create');

		Route::get('cobranca', 'PaymentsController@bill')->name('bill');

		Route::post('cobranca', 'BillsController@purchase')->name('bill.purchase');

	});

	Route::prefix('cadastro')->name('profile.')->group(function() {

		Route::get('', 'UsersController@profile')->name('show');

		Route::post('', 'UsersController@update')->name('update');

		Route::post('/password', 'UsersController@password')->name('update.password');

		Route::post('/creditCard', 'UsersController@creditCard')->name('update.creditCard');

		Route::post('/creditCard/remove', 'UsersController@removeCard')->name('remove.creditCard');

	});

	Route::prefix('workshops')->name('workshops.')->group(function() {

		Route::get('', 'UsersController@workshops')->name('index');

	});
});

Route::prefix('status')->name('status.')->group(function() {

	Route::get('ajax', 'EventsController@ajax')->name('ajax');

	Route::get('workshop', 'WorkshopsController@status')->name('workshop');

	Route::get('{transaction_code}', 'PagSeguroController@status')->name('payment');

});

Route::get('/', function () {
	$workshops = \App\Workshop::upcoming()->take(3)->get();

    return view('pages.welcome.index', compact('workshops'));
})->name('welcome');

Route::get('/quem-somos', function () {
    return view('pages.about.index');
});

Route::get('/consultoria', function () {
    return view('pages.consulting.index');
});

Route::get('/contato', function () {
    return view('pages.contact.index');
})->name('contact');

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
		
		Route::get('/pagamento', 'WorkshopsController@payment')->name('payment');

		Route::post('cancel', 'WorkshopsController@cancel')->name('cancel');

		Route::post('', 'WorkshopsController@purchase')->name('purchase');

	});

});

Route::prefix('eventos')->name('events.')->group(function() {

	Route::get('/buscar', 'EventsController@search')->name('search');

	Route::post('{event}', 'EventsController@cancel')->name('cancel');

});

Route::get('plan/create', function() {
	$planos = \App\Plan::where('id', '!=', 1)->get();

	// foreach ($planos as $plan) {
	// 	(new \App\Services\PagSeguro\PagSeguro)->createPlan($plan);
	// }

	return 'Planos criados';
});