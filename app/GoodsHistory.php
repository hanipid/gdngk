<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsHistory extends Model
{
	protected $guarded = ['id'];

	public function incomingGoods()
	{
		return $this->belongsTo('\App\IncomingGoods', 'incoming_goods_id', 'id');
	}

	public function storedGoods()
	{
		return $this->belongsTo('\App\StoredGoods', 'stored_goods_id', 'id');
	}

	public function shrinkage()
	{
		return $this->belongsTo('\App\Shrinkage', 'shrinkage_id', 'id');
	}

	public function employee()
	{
		return $this->belongsTo('\App\User', 'employee_id', 'id');
	}

	public function farmer()
	{
		return $this->belongsTo('\App\User', 'farmer_id', 'id');
	}


	public function warehouse()
	{
		return $this->belongsTo('\App\Warehouse', 'warehouse_id', 'id');
	}

	public function commodityGrade()
	{
		return $this->belongsTo('\App\CommodityGrade', 'commodity_grade_id', 'id');
	}
}
