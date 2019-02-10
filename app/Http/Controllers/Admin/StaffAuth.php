<?php

namespace App\Http\Controllers\Admin;
use App\staff;
//use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Mail\StaffResetPassword;
use Carbon\Carbon;
use DB;
use Mail;

class StaffAuth extends Controller {
    //

    public function login() {
        return view('staff.login');
    }

    public function dologin() {
        $rememberme = request('rememberme') == 1?true:false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect('staff');
        } else {
            session()->flash('error', trans('staff.inccorrect_information_login'));
            return redirect(aurl('staff/login'));
        }
    }

    public function logout() {
        auth()->guard('staff')->logout();
        return redirect(aurl('login'));
    }

    public function forgot_password() {
        return view('staff.forgot_password');
    }

    public function forgot_password_post() {
        $staff = Staff::where('email', request('email'))->first();
        if (!empty($staff)) {
            $token = app('auth.password.broker')->createToken($staff);
            $data  = DB::table('password_resets')->insert([
                'email'      => $staff->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($staff->email)->send(new staffResetPassword(['data' => $staff, 'token' => $token]));
            session()->flash('success', trans('staff.the_link_reset_sent'));
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
            $staff = staff::where('email', $check_token->email)->update([
                'email'    => $check_token->email,
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            staff()->attempt(['email' => $check_token->email, 'password' => request('password')], true);
            return redirect(aurl());
        } else {
            return redirect(aurl('forgot/password'));
        }
    }

    public function reset_password($token) {
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if (!empty($check_token)) {
            return view('staff.reset_password', ['data' => $check_token]);
        } else {
            return redirect(aurl('forgot/password'));
        }
    }
}
