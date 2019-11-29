<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseRentalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_rental_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('commodities', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_id')->unsigned()->index();
            } else {
                $table->integer('commodity_id')->unsigned()->index();
            }
            $table->foreign('commodity_id')->references('id')->on('commodities')->onDelete('cascade');

            $table->double('rental_price', 20, 2);
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
        Schema::dropIfExists('warehouse_rental_histories');
    }
}
