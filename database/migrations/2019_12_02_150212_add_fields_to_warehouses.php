<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToWarehouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            $type = DB::connection()->getDoctrineColumn('warehouse_categories', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('warehouse_category_id')->unsigned()->index()->after('commodity_id')->nullable();
            } else {
                $table->integer('warehouse_category_id')->unsigned()->index()->after('commodity_id')->nullable();
            }
            $table->foreign('warehouse_category_id')->references('id')->on('warehouse_categories');

            $type = DB::connection()->getDoctrineColumn('districts', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('district_id')->unsigned()->index()->after('warehouse_category_id')->nullable();
            } else {
                $table->integer('district_id')->unsigned()->index()->after('warehouse_category_id')->nullable();
            }
            $table->foreign('district_id')->references('id')->on('districts');

            $type = DB::connection()->getDoctrineColumn('villages', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('village_id')->unsigned()->index()->after('district_id')->nullable();
            } else {
                $table->integer('village_id')->unsigned()->index()->after('district_id')->nullable();
            }
            $table->foreign('village_id')->references('id')->on('villages');

            $table->string('number_date')->nullable()->after('village_id');
            $table->string('unit_area')->nullable()->after('number_date');
            $table->dropColumn('kecamatan');
            $table->dropColumn('desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            $table->dropColumn('district_id');
            $table->dropColumn('village_id');
            $table->dropColumn('number_date');
            $table->dropColumn('unit_area');
            $table->string('kecamatan')->nullable()->after('address');
            $table->string('desa')->nullable()->after('kecamatan');
        });
    }
}
