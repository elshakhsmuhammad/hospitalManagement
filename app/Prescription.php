<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table    = 'prescriptions';
    protected $fillable = [
        'description','quantity','medicine_id','patient_id',


        'doctor_id'
    ];
    public function doctor_id() {
        return $this->belongsTo('App\Doctor', 'doctor_id', 'id');
    }
    public function patient_id() {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
    public function medicine_id() {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }
}