<?php
Route::group(['prefix' => 'staff', 'namespace' => 'Staff'], function () {

Config::set('auth.defines', 'staff');
Route::get('login', 'StaffAuth@login');
Route::post('login', 'StaffAuth@dologin');
Route::get('forgot/password', 'StaffAuth@forgot_password');
Route::post('forgot/password', 'StaffAuth@forgot_password_post');
Route::get('reset/password/{token}', 'StaffAuth@reset_password');
Route::post('reset/password/{token}', 'StaffAuth@reset_password_final');
 Route::group(['middleware' => 'staff:staff'], function () {
    Route::get('/',function (){
        return view('staff/home');
    });
    Route::any('logout', 'StaffAuth@logout');
});
});