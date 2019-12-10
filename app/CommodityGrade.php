<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommodityGrade extends Model
{
    protected $fillable = ['commodity_id', 'name', 'price'];

    public function commodity()
    {
    		return $this->belongsTo('App\Commodity', 'commodity_id', 'id');
    }
}
