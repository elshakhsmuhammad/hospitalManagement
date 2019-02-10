<?php
Route::group(['prefix' => 'patient', 'namespace' => 'Patient'], function () {

    Config::set('auth.defines', 'patient');
    Route::get('login', 'PatientAuth@login');
    Route::post('login', 'PatientAuth@dologin');
    Route::get('forgot/password', 'PatientAuth@forgot_password');
    Route::post('forgot/password', 'PatientAuth@forgot_password_post');
    Route::get('reset/password/{token}', 'PatientAuth@reset_password');
    Route::post('reset/password/{token}', 'PatientAuth@reset_password_final');

 Route::group(['middleware' => 'patient:patient'], function () {
      Route::resource('patient', 'PatientProfileController');
   // Route::get('/',function (){
      //  return view('patients/home');


      Route::resource('task', 'PatientTaskController');
        Route::resource('info', 'PatientInfoController');
  //  });
    Route::any('logout', 'PatientAuth@logout');
});
});