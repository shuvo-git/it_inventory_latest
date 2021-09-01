<?php
Route::group(['middleware'=>['web','auth']],function(){
    Route::get('products/upcoming-exp','ProductsController@upcomingExp')->name('products.exp');
    Route::get('products/short-list','ProductsController@shortList')->name('products.shortList');
    Route::post('products/details','ProductsController@details')->name('products.details');
    Route::post('products/subGroup','ProductsController@subGroup')->name('products.subGroup');
    Route::post('products/bulk-upload','ProductsController@bulkUpload')->name('products.bulkUpload');
    Route::resource('products', 'ProductsController');
    Route::post('products/product-details','ProductsController@productDetails')->name('products.product-details');
});

