<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
	Route::resource('receive-from-vendor', ReceiveFromVendorController::class);
});
