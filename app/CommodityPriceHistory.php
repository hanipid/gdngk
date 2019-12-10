<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommodityPriceHistory extends Model
{
    protected $guarded = ['id'];

    public function commodityGrade()
    {
    		return $this->belongsTo('App\CommodityGrade');
    }
}
