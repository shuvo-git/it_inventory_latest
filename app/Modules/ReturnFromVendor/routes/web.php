<?php

use Illuminate\Support\Facades\Route;

Route::resource('return-from-vendor', ReturnFromVendorController::class);
Route::post('get-in-vendor-product', 'ReturnFromVendorController@getInVendorProduct');