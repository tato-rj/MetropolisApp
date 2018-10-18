<?php

Auth::routes();

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

Route::post('/buscar', 'SpacesController@search');

Route::get('/home', 'HomeController@index')->name('home');
