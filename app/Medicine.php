<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table    = 'medicines';
    protected $fillable = [
        'name',  'description','type',
        'icon',
        'quantity','price',
        'expired'
    ];
    public function category_id() {
        return $this->belongsTo('App\Category', 'id', 'category_id');
    }
    public function doctors() {
        return $this->belongsToMany('App\Doctor');
    }
    public function patients() {
        return $this->belongsToMany('App\Patient');
    }
}
