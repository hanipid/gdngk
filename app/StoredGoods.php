<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoredGoods extends Model
{
    protected $guarded = ['id'];

    public function warehouseReceipt()
    {
    		return $this->belongsTo('App\WarehouseReceipt');
    }

    public function commodityGrade()
    {
    		return $this->belongsTo('App\CommodityGrade');
    }
}
