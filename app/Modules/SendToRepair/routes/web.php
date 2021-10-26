<?php
use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
	Route::resource('send-to-repair', 'SendToRepairController');
	Route::post('getReturnedProduct', 'SendToRepairController@getReturnedProduct');
	Route::post('getProductExpiryDate', 'SendToRepairController@getProductExpiryDate');
});
