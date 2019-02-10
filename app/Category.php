<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table    = 'categories';
    protected $fillable = [
        'name',


        'medicine',
    ];

    public function medicines() {
        return $this->hasMany('App\Medicine', 'id', 'medicines');
    }

}
