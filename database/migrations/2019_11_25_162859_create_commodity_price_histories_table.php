<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommodityPriceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_price_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('commodity_grades', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_grade_id')->unsigned()->index();
            } else {
                $table->integer('commodity_grade_id')->unsigned()->index();
            }
            $table->foreign('commodity_grade_id')->references('id')->on('commodity_grades')->onDelete('no action');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('user_id')->unsigned()->index()->comment('who was inserting (admin user)');
            } else {
                $table->integer('user_id')->unsigned()->index()->comment('who was inserting (admin user)');
            }

            $table->date('date');
            $table->decimal('price', 20, 2);
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
        Schema::dropIfExists('commodity_price_histories');
    }
}
