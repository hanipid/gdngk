<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('incoming_goods', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('incoming_goods_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('incoming_goods_id')->unsigned()->index()->nullable();
            }
            $table->foreign('incoming_goods_id')->references('id')->on('incoming_goods');

            $type = DB::connection()->getDoctrineColumn('stored_goods', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('stored_goods_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('stored_goods_id')->unsigned()->index()->nullable();
            }
            $table->foreign('stored_goods_id')->references('id')->on('stored_goods');

            $type = DB::connection()->getDoctrineColumn('shrinkages', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('shrinkage_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('shrinkage_id')->unsigned()->index()->nullable();
            }
            $table->foreign('shrinkage_id')->references('id')->on('shrinkages');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('employee_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('employee_id')->unsigned()->index()->nullable();
            }
            $table->foreign('employee_id')->references('id')->on('users');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('farmer_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('farmer_id')->unsigned()->index()->nullable();
            }
            $table->foreign('farmer_id')->references('id')->on('users');

            $type = DB::connection()->getDoctrineColumn('warehouses', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('warehouse_id')->unsigned()->index()->nullable();
            }
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $type = DB::connection()->getDoctrineColumn('commodity_grades', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_grade_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('commodity_grade_id')->unsigned()->index()->nullable();
            }
            $table->foreign('commodity_grade_id')->references('id')->on('commodity_grades');

            $table->double('weight', 20, 2)->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_histories');
    }
}
