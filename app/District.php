<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
		public function warehouses()
		{
				return $this->hasMany('App\Warehouse');
		}
}
