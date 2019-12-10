<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingGoods extends Model
{
	protected $fillable = ['employee_id', 'farmer_id', 'warehouse_id', 'commodity_grade_id', 'weight'];
    // protected $table = 'incoming_goods';
	public function commodityGrade()
	{
		return $this->belongsTo('\App\CommodityGrade', 'commodity_grade_id', 'id');
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
		return $this->belongsTo('\App\Warehouse');
	}
}
