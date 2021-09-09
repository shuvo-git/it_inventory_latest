<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['web','auth']],function(){
    Route::resource('returns', ReturnsController::class);
    Route::post('get-delivered-stocks', "ReturnsController@getDeliveredProduct");
});