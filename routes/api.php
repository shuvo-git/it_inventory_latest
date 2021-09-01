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


Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'Auth\LoginController@apiLogin');
});
Route::group(['prefix' => 'v1','middleware'=>'api','namespace'=>'Api\v1'], function () {
    Route::get('dropdown-all', 'CommonApiController@allDropDown');
    Route::get('get-map', 'CommonApiController@map');
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
