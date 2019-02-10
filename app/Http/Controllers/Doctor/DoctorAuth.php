<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Admin;
use App\Doctor;
//use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Mail\DoctorResetPassword;
use Carbon\Carbon;
use DB;
use Mail;

class DoctorAuth extends Controller {
    //

    public function login() {
        return view('doctors.login');
    }

    public function dologin() {
        $rememberme = request('rememberme') == 1?true:false;
        if (doctor()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect (url('doctor/home'));
        } else {
            session()->flash('error', trans('doctor.inccorrect_information_login'));
            return redirect(url('doctor/login'));
        }
    }

    public function logout() {
        auth()->guard('doctor')->logout();
        return redirect(url('doctor/login'));
    }

    public function forgot_password() {
        return view('doctor.forgot_password');
    }

    public function forgot_password_post() {
        $doctor = Doctor::where('email', request('email'))->first();
        if (!empty($doctor)) {
            $token = app('auth.password.broker')->createToken($doctor);
            $data  = DB::table('password_resets')->insert([
                'email'      => $doctor->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($doctor->email)->send(new DoctorResetPassword(['data' => $doctor, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_reset_sent'));
            return back();
        }
        return back();
    }

    public function reset_password_final($token) {

        $this->validate(request(), [
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [], [
            'password'              => 'Password',
            'password_confirmation' => 'Confirmation Password',
        ]);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            $doctor = Doctor::where('email', $check_token->email)->update([
                'email'    => $check_token->email,
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            doctor()->attempt(['email' => $check_token->email, 'password' => request('password')], true);
            return redirect(aurl());
        } else {
            return redirect(aurl('doctor/forgot/password'));
        }
    }

    public function reset_password($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            return view('doctors.reset_password', ['data' => $check_token]);
        } else {
            return redirect(url('doctor/forgot/password'));
        }
    }
}
