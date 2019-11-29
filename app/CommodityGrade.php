<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommodityGrade extends Model
{
    protected $fillable = ['commodity_id', 'name', 'price'];

    public function commodity()
    {
    		$this->belongsTo('App\Commodity');
    }
}
