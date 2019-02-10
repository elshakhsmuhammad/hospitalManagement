<?php

namespace App\Providers;

use App\Doctor;
use App\Staff;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//

		 Schema::defaultStringLength(120);
		 Schema::enableForeignKeyConstraints();
        $doctor = Doctor::all();
        view()->share('doctors',$doctor);
        $staff = Staff::all();
        view()->share('staff',$staff);
        $patient = Doctor::all();
        view()->share('patients',$patient);

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
