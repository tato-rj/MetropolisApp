<?php

Route::prefix('admin')->name('admin.')->group(function() {

	Route::get('', 'AdminController@dashboard')->name('dashboard');

	Route::get('/agenda', 'AdminController@schedule')->name('schedule');
	
	Route::prefix('usuarios')->name('users.')->group(function() {
	
		Route::get('', 'AdminController@users')->name('index');
	
		Route::get('/datatable', 'UsersController@datatable')->name('datatable');

		Route::get('/{user}', 'UsersController@edit')->name('edit');

	});

	Route::get('/workshops', 'AdminController@workshops')->name('workshops');

	Route::get('/pagamentos', 'AdminController@payments')->name('payments');
	
});