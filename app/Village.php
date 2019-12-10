<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    public function warehouses()
    {
    		return $this->hasMany('App\Warehouse');
    }

    public function district()
    {
    	 	return $this->belongsTo('App\District');
    }
}
