<?php

// use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>['web','auth']],function(){
	Route::get('deliver-to-branch', 'DeliverToBranchController@welcome');
});