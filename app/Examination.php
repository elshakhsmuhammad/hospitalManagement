<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table    = 'examinations';
    protected $fillable = [
          'description','patient_id',


        'doctor_id'
    ];
    public function doctor_id() {
        return $this->belongsTo('App\Doctor', 'doctor_id', 'id');
    }
    public function patient_id() {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
}