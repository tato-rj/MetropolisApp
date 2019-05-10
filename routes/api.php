<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/pagseguro/notification', 'PagSeguroController@notification')->name('pagseguro.event.notification');

Route::get('/pagseguro/status', 'PagSeguroController@status')->name('pagseguro.event.status');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
