<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
    Route::resource('stock-in', StockInController::class);
    Route::post('stock-in/update-stock-status', 'StockInController@updateStockStatus')->name('update-stock-status');
});