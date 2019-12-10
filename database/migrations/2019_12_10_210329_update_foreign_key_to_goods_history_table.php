<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyToGoodsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_histories', function (Blueprint $table) {
			$table->dropForeign(['incoming_goods_id']);
            $table->foreign('incoming_goods_id')->references('id')->on('incoming_goods')->onDelete('SET NULL');
			$table->dropForeign(['commodity_grade_id']);
            $table->foreign('commodity_grade_id')->references('id')->on('commodity_grades')->onDelete('NO ACTION');
			$table->dropForeign(['employee_id']);
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('NO ACTION');
			$table->dropForeign(['farmer_id']);
            $table->foreign('farmer_id')->references('id')->on('users')->onDelete('NO ACTION');
			$table->dropForeign(['shrinkage_id']);
            $table->foreign('shrinkage_id')->references('id')->on('shrinkages')->onDelete('NO ACTION');
			$table->dropForeign(['stored_goods_id']);
            $table->foreign('stored_goods_id')->references('id')->on('stored_goods')->onDelete('NO ACTION');
			$table->dropForeign(['warehouse_id']);
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_history', function (Blueprint $table) {
            //
        });
    }
}
