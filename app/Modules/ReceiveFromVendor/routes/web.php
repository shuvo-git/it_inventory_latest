<?php

// use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
	Route::get('receive-from-vendor', 'ReceiveFromVendorController@welcome');
});
