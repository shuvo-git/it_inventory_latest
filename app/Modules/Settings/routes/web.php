<?php
Route::group(['middleware'=>['web','auth']],function(){
	Route::get('settings', 'SettingsController@welcome');
});