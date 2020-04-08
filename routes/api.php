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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');
Route::post('check-user', 'APIController@checkUser');


//Route::resource('currencies', 'CurrencyController');
Route::get('currencies', 'CurrencyController@index');
Route::get('currencies/{id}', 'CurrencyController@show');
Route::get('currencies/find-by-code/{code}', 'CurrencyController@getCurrencyByCode');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'APIController@logout');

    //Route::resource('transaction', 'TransactionController');

    Route::get('transactions', 'TransactionController@index');
    Route::get('transactions/{id}', 'TransactionController@show');
    Route::post('transactions', 'TransactionController@store');
    Route::put('transactions/{id}', 'TransactionController@update');
    Route::delete('transactions/{id}', 'TransactionController@destroy');
    Route::get('transactions/find-by-type/{type}', 'Transaction@getTransactionByType');

    
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');
    Route::post('categories', 'CategoryController@store');
    Route::put('categories/{id}', 'CategoryController@update');
    Route::delete('categories/{id}', 'CategoryController@destroy');

});