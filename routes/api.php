<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('accounts', 'ApiController@getAllAccounts');
Route::get('accounts/{id}', 'ApiController@getAccount');
Route::get('accounts/nric/{nric}', 'ApiController@getAccountByNRIC');
Route::post('accounts', 'ApiController@createAccount');
Route::put('accounts/{id}', 'ApiController@updateAccount');
Route::put('accounts/nric/{nric}', 'ApiController@updateAccountBalanceByNRIC');
Route::delete('accounts/{id}','ApiController@deleteAccount');


