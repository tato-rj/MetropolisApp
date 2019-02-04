<?php

Route::prefix('admin')->group(function() {

	Route::get('', function() {
		return view('admin.pages.dashboard.index');
	});

});