<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use Notifiable;
    protected $table    = 'patients';
    protected $fillable = [
        'name',  'password',
        'specialized', 'icon',
        'phone','gender',
        'email','description',
        'department_id'
    ];
    public function department_id() {
        return $this->belongsTo('App\Model\Department', 'department_id', 'id');
    }
    public function examinations() {
        return $this->hasMany('App\Examination');
    }
    public function medicines() {
        return $this->hasMany('App\Medicine');
    }
    public function doctors() {
        return $this->belongsToMany('App\Doctor');
    }
}
