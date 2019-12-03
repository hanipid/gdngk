<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $type = DB::connection()->getDoctrineColumn('districts', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('district_id')->unsigned()->index()->nullable();
            } else {
                $table->integer('district_id')->unsigned()->index()->nullable();
            }
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('name');
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
        Schema::dropIfExists('villages');
    }
}
