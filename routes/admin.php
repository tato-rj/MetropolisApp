<?php

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function() {

	Route::get('', 'AdminController@dashboard')->name('dashboard');

	Route::prefix('agenda')->name('schedule.')->group(function() {
		
		Route::get('', 'AdminController@schedule')->name('index');

		Route::get('/novo-evento', 'EventsController@create')->name('create');

		Route::post('', 'EventsController@store')->name('store');

		Route::get('/checar', 'SpacesController@check')->name('check');
	
	});
	
	Route::prefix('usuarios')->name('users.')->group(function() {
	
		Route::get('', 'AdminController@users')->name('index');
	
		Route::get('/datatable', 'UsersController@datatable')->name('datatable');

		Route::get('/{user}', 'UsersController@edit')->name('edit');

	});

	Route::prefix('workshops')->name('workshops.')->group(function() {

		Route::get('', 'AdminController@workshops')->name('index');

		Route::get('novo', 'WorkshopsController@create')->name('create');

		Route::post('novo', 'WorkshopsController@store')->name('store');

		Route::get('{workshop}', 'WorkshopsController@edit')->name('edit');

		Route::post('{workshop}', 'WorkshopsController@update')->name('update');

		Route::delete('{workshop}', 'WorkshopsController@destroy')->name('destroy');

		Route::prefix('{workshop}/arquivo')->name('file.')->group(function() {

			Route::post('', 'WorkshopsFilesController@store')->name('store');

			Route::delete('{file}/deletar', 'WorkshopsFilesController@destroy')->name('destroy');

		});

	});

	Route::get('/pagamentos', 'AdminController@payments')->name('payments');
	
});

Route::prefix('admin')->middleware('guest:admin')->namespace('Auth\Admin')->name('admin.')->group(function() {

	Route::prefix('login')->name('login.')->group(function() {

		Route::get('', 'LoginController@showLoginForm')->name('show');

		Route::post('', 'LoginController@login')->middleware('admin.new')->name('submit');
	
	});

	Route::prefix('password')->name('password.')->group(function() {

		Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('email');

		Route::get('mudar', 'ForgotPasswordController@showLinkRequestForm')->name('request');

		Route::post('mudar', 'ResetPasswordController@reset');
	
		Route::get('mudar/novo-admin', 'ResetPasswordController@showRequiredResetForm')->name('required-reset');

		Route::post('mudar/novo-admin', 'ResetPasswordController@saveNewPassword')->name('required-save');

		Route::get('mudar/{token}', 'ResetPasswordController@showResetForm')->name('reset');

	});

});