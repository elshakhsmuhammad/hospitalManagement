<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reckoning extends Model
{
    protected $table    = 'reckonings';
    protected $fillable = [
        'create',
        'staff_id',
        'patient_id',
        'medicine_id',
        'quantity',
        'day',
        'price',
        'Surgeries_price',
        'other'
    ];
    public function staff_id() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
    public function medicine_id()
    {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }
    public function patient_id() {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }
}