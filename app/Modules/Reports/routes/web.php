<?php

Route::group(['middleware'=>['web','auth'],'prefix'=>'report'],function(){
    Route::get('daily','ReportController@daily')->name('report.daily');
    Route::get('monthly','ReportController@monthly')->name('report.monthly');
    Route::get('product-wise-sell','ReportController@productWiseSell')->name('report.productWiseSell');
    Route::get('day-wise-sell','ReportController@dayWiseSell')->name('report.dayWiseSell');
    Route::post('set-balance','ReportController@setBalance')->name('setBalance.store');
});
