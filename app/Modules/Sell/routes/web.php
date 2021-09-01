<?php

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::post('sell/product-details','SellController@details')->name('sell.product-details');
    Route::post('sell/category-products','SellController@categoryProducts')->name('sell.category-products');
    Route::resource('sell', 'SellController');
    Route::resource('return', 'ReturnController');
    Route::resource('computerWork', 'ComputerWorkController');
});
