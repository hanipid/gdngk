<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = ['code', 'name', 'rental_price'];

    public function warehouses()
    {
    		return $this->hasMany('App\Warehouse');
    }

    public function commodityGrades()
    {
    		return $this->hasMany('App\CommodityGrade');
    }

    public function warehouseRentalHistories()
    {
    	return $this->hasMany('App\WarehouseRentalHistory');
    }
}
