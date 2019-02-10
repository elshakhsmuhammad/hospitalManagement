<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {
	protected $table    = 'departments';
	protected $fillable = [
		'name',
		'capacity',
		'icon',

		'patient',
	];

	public function patients() {
		return $this->hasMany('App\Patient', 'id', 'patients');
	}

}
