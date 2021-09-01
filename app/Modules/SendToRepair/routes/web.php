<?php

// use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
	Route::get('send-to-repair', 'SendToRepairController@welcome');
});
