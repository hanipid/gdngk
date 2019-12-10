<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseRentalHistory extends Model
{
    protected $guarded = ['id'];

    public function commodity()
    {
    	return $this->belongsTo('App\Commodity');
    }
}
