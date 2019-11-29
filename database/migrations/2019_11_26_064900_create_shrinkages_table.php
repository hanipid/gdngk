<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShrinkagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shrinkages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('stored_goods', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('stored_goods_id')->unsigned()->index();
            } else {
                $table->integer('stored_goods_id')->unsigned()->index();
            }
            $table->foreign('stored_goods_id')->references('id')->on('stored_goods')->onDelete('cascade');

            $table->date('date');
            $table->double('weight', 20, 2);
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
        Schema::dropIfExists('shrinkages');
    }
}
