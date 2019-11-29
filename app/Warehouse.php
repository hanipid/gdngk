<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	protected $fillable = ['user_id', 'commodity_id', 'capacity', 'address', 'kecamatan', 'desa', 'latitude', 'longitude', 'information', 'photo'];

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
        return $this->belongsTo('App\User');
    }

    public function commodity()
    {
    	return $this->belongsTo('App\Commodity');
    }
}
