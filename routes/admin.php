<?php
/////doctor auth

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

		Config::set('auth.defines', 'admin');
		Route::get('login', 'AdminAuth@login');
		Route::post('login', 'AdminAuth@dologin');
		Route::get('forgot/password', 'AdminAuth@forgot_password');
		Route::post('forgot/password', 'AdminAuth@forgot_password_post');
		Route::get('reset/password/{token}', 'AdminAuth@reset_password');
		Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');




	          	  Route::group(['middleware' => 'admin:admin'], function () {

				Route::resource('admin', 'AdminController');
				Route::delete('admin/destroy/all', 'AdminController@multi_delete');

				Route::resource('users', 'UsersController');
				Route::delete('users/destroy/all', 'UsersController@multi_delete');
				Route::resource('staff', 'StaffController');
				Route::delete('staff/destroy/all', 'StaffController@multi_delete');
				Route::resource('doctors', 'DoctorController');
				Route::delete('doctors/destroy/all', 'DoctorController@multi_delete');

				Route::resource('countries', 'CountriesController');

				Route::delete('countries/destroy/all', 'CountriesController@multi_delete');

				Route::resource('cities', 'CitiesController');
				Route::delete('cities/destroy/all', 'CitiesController@multi_delete');

				Route::resource('states', 'StatesController');
				Route::delete('states/destroy/all', 'StatesController@multi_delete');

				Route::resource('trademarks', 'TradeMarksController');
				Route::delete('trademarks/destroy/all', 'TradeMarksController@multi_delete');

				Route::resource('departments', 'DepartmentsController');
                Route::delete('departments/destroy/all', 'DepartmentsController@multi_delete');
                Route::resource('patients', 'PatientController');
                Route::delete('patients/destroy/all', 'PatientController@multi_delete');
                Route::resource('medicines', 'MedicineController');
                Route::delete('medicines/destroy/all', 'MedicineController@multi_delete');
                //// bills///////
               Route::resource('reckonings', 'ReckoningsController');
               Route::delete('reckonings/destroy/all', 'ReckoningsController@multi_delete');
               //////Examinations purchases
               Route::resource('examinations', 'ExaminationsController');
               Route::delete('examinations/destroy/all', 'ExaminationsController@multi_delete');
/////////////////////purchases
               Route::resource('purchases', 'PurchasesController');
               Route::delete('purchases/destroy/all', 'PurchasesController@multi_delete');
               ////////////Transactions
            Route::resource('transactions', 'TransactionsController');
            Route::delete('transactions/destroy/all', 'TransactionsController@multi_delete');
				Route::get('/', function () {
						return view('admin.home');
					});

				Route::get('settings', 'Settings@setting');
				Route::post('settings', 'Settings@setting_save');

				Route::any('logout', 'AdminAuth@logout');
			});

		Route::get('lang/{lang}', function ($lang) {
				session()->has('lang')?session()->forget('lang'):'';
				$lang == 'ar'?session()->put('lang', 'ar'):session()->put('lang', 'en');
				return back();
			});
	});