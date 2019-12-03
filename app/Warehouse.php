<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	protected $fillable = ['user_id', 'employee_id', 'commodity_id', 'warehouse_category_id', 'capacity', 'address', 'district_id', 'village_id', 'number_date', 'unit_area', 'latitude', 'longitude', 'information', 'photo'];

	public function setCapacityAttribute($value)
	{
		$this->attributes['capacity'] = $value * 1000;
	}

    public function setPhotoAttribute($value)
    {
        if (is_file($value))
            $this->attributes['photo'] = 'warehouses/' . $this->address . $this->user_id . $this->commodity_id . '.' . $value->getClientOriginalExtension();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }

    public function commodity()
    {
    	return $this->belongsTo('App\Commodity');
    }

    public function warehouseCategory()
    {
        return $this->belongsTo('App\WarehouseCategory');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function village()
    {
        return $this->belongsTo('App\Village');
    }
}
