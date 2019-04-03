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

Route::prefix('shopping_cart')->group(function () {
    Route::get('/', 'ShoppingCartController@index');
    Route::post('/', 'ShoppingCartController@addProduct');
    Route::delete('/{id}', 'ShoppingCartController@removeProduct')
        ->where('id', '[0-9]+');
    Route::put('/{id}/{amount}', 'ShoppingCartController@updateAmountOfProducts')
        ->where(['id' => '[0-9]+', 'amount' => '[0-9]+']);
});
