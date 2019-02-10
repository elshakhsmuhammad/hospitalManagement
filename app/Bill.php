<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
   
    protected $table    = 'bills';
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
    public function medicine_id() {
        return $this->belongsTo('App\Medicine', 'medicine_id', 'id');
    }
}