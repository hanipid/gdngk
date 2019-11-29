<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('user_id')->unsigned()->index();
            } else {
                $table->integer('user_id')->unsigned()->index();
            }
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $type = DB::connection()->getDoctrineColumn('commodities', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('commodity_id')->unsigned()->index();
            } else {
                $table->integer('commodity_id')->unsigned()->index();
            }
            $table->foreign('commodity_id')->references('id')->on('commodities')->onDelete('cascade');

            $table->double('capacity', 10, 2);
            $table->string('address');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('information')->nullable();
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
        Schema::dropIfExists('warehouses');
    }
}
