<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseReceipt extends Model
{
    protected $guarded = ['id'];

    public function warehouse()
    {
    	return $this->belongsTo('App\Warehouse');
    }

    public function warehouseEmployee()
    {
    	return $this->belongsTo('App\User', 'warehouse_employee_id', 'id');
    }

    public function adminEmployee()
    {
    	return $this->belongsTo('App\User', 'admin_employee_id', 'id');
    }

    public function farmer()
    {
    	return $this->belongsTo('App\User', 'farmer_id', 'id');
    }

    public function storedGoods()
    {
    	return $this->hasMany('App\StoredGoods');
    }
}
