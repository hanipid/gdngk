<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_goods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('warehouse_receipts', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_receipt_id')->unsigned()->index();
            } else {
                $table->integer('warehouse_receipt_id')->unsigned()->index();
            }
            $table->foreign('warehouse_receipt_id')->references('id')->on('warehouse_receipts')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('commodity_grades', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_grade_id')->unsigned()->index();
            } else {
                $table->integer('commodity_grade_id')->unsigned()->index();
            }
            $table->foreign('commodity_grade_id')->references('id')->on('commodity_grades')->onDelete('cascade');

            $table->date('date');
            $table->double('weight', 20, 2)->comment('jumlah berat kg');
            $table->double('asking_price', 20, 2)->nullable()->comment('sesuai harga pasar ketika petani menjual ke gudang');
            $table->double('selling_price', 20, 2)->nullable()->comment('sesuai harga pasar ketika pembeli membeli ke gudang');
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
        Schema::dropIfExists('stored_goods');
    }
}
