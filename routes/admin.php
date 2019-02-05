<?php

Route::prefix('admin')->name('admin.')->group(function() {

	Route::get('', 'AdminController@dashboard')->name('dashboard');

	Route::get('/agenda', 'AdminController@schedule')->name('schedule');
	
	Route::get('/usuarios', 'AdminController@users')->name('users');

	Route::get('/workshops', 'AdminController@workshops')->name('workshops');

	Route::get('/pagamentos', 'AdminController@payments')->name('payments');
	
});