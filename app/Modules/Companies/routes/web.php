<?php
Route::group(['middleware'=>['web','auth']],function(){
    Route::resource('companies', 'CompaniesController');
});


