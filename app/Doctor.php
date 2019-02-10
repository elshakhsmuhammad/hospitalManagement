<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table    = 'doctors';
    protected $fillable = [
        'name',  'password',
        'specialized', 'icon',
        'phone','gender',
        'email'
    ];
    public function examinations() {
        return $this->hasMany('App\Examination');
    }
    public function prescriptions() {
        return $this->hasMany('App\Prescription');
    }
    public function patients() {
        return $this->hasMany('App\Patient');
    }
    public function medicines() {
        return $this->hasMany('App\Medicine');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
