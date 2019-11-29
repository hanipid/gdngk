<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_goods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('employee_id')->unsigned()->index();
            } else {
                $table->integer('employee_id')->unsigned()->index();
            }
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('farmer_id')->unsigned()->index();
            } else {
                $table->integer('farmer_id')->unsigned()->index();
            }
            $table->foreign('farmer_id')->references('id')->on('users')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('warehouses', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_id')->unsigned()->index();
            } else {
                $table->integer('warehouse_id')->unsigned()->index();
            }
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('commodity_grades', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_grades_id')->unsigned()->index();
            } else {
                $table->integer('commodity_grades_id')->unsigned()->index();
            }
            $table->foreign('commodity_grades_id')->references('id')->on('commodity_grades')->onDelete('cascade');

            $table->double('weight', 20, 2);
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
        Schema::dropIfExists('incoming_goods');
    }
}
