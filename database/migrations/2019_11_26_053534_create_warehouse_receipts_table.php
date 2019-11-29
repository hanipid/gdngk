<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('warehouses', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_id')->unsigned()->index();
            } else {
                $table->integer('warehouse_id')->unsigned()->index();
            }
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_employee_id')->unsigned()->index();
            } else {
                $table->integer('warehouse_employee_id')->unsigned()->index();
            }
            $table->foreign('warehouse_employee_id')->references('id')->on('users')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('admin_employee_id')->unsigned()->index();
            } else {
                $table->integer('admin_employee_id')->unsigned()->index();
            }
            $table->foreign('admin_employee_id')->references('id')->on('users')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('farmer_id')->unsigned()->index();
            } else {
                $table->integer('farmer_id')->unsigned()->index();
            }
            $table->foreign('farmer_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('receipt_number')->unique();
            $table->double('warehouse_rental', 20, 2);
            $table->date('date');
            $table->double('downpayment', 20, 2)->nullable();
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
        Schema::dropIfExists('warehouse_receipts');
    }
}
