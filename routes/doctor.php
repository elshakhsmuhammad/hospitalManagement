<?php
/////doctor auth

Route::group(['prefix' => 'doctor', 'namespace' => 'Doctor'], function () {
    Config::set('auth.defines', 'doctor');
    Route::get('/login', 'DoctorAuth@login');
    Route::post('/login', 'DoctorAuth@dologin');
    Route::get('/forgot/password', 'DoctorAuth@forgot_password');
    Route::post('/forgot/password', 'DoctorAuth@forgot_password_post');
    Route::get('/reset/password/{token}', 'DoctorAuth@reset_password');
    Route::post('/reset/password/{token}', 'DoctorAuth@reset_password_final');
    Route::group(['middleware' => 'doctor:doctor'], function () {
        Route::resource('doctor', 'DoctorProfileController');
        Route::resource('task', 'DoctorTaskController');
        Route::resource('info', 'DoctorInfoController');
        Route::get('/inf/{id}', 'DoctorInfoController@edit')->name('edit');
        Route::get('/inf/{id}', 'DoctorInfoController@update')->name('update');
        Route::delete('doctor/doctor/{id}/delete', 'DoctorProfileController@deleteIt')->name('deleteEamination');
         Route::delete('doctor/task/{id}/delete', 'DoctorProfileController@destroy')->name('deletePrescription');
        Route::get('/photo/{id}/editPhoto', 'DoctorProfileController@editPhoto')->name('upload');
        Route::post('/photo/{id}/upload', 'DoctorProfileController@upload')->name('upload');
    Route::get('/home',function (){
        return view('doctors/home');
    });
    Route::any('logout', 'DoctorAuth@logout');
});


});