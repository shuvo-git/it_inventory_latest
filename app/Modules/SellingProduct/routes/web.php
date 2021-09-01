<?php
Route::group(['middleware'=>['web','auth']],function(){
	Route::resource('selling-product', 'SellingProductController');
    Route::post('selling-product/details','SellingProductController@details')->name('selling-product.details');
});