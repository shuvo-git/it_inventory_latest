<?php

Route::group(['middleware' => 'auth'], function () {
    Route::resource('system-users', 'SystemUserController');
    Route::post('change-password','SystemUserController@changePassword')->name('change-password');
});

Route::get('forget-password','ForgetPasswordController@form')->name('forget-password');
Route::post('forget-password','ForgetPasswordController@sendOtp')->name('forget-password.otp');
Route::get('forget-password-otp','ForgetPasswordController@formOtp')->name('forget-password.otp-view');
Route::post('forget-password-otp-verify','ForgetPasswordController@otpVerify')->name('forget-password.otp-verify');
