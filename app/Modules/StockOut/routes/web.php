<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
    Route::resource('stock-out', StockOutController::class);
    Route::post('stock-detail', "StockOutController@getStockDetails");
});