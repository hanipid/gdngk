<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeToWarehouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            $type = DB::connection()->getDoctrineColumn('users', 'id')->getType()->getName();
            if ($type == 'bigint') {
                $table->bigInteger('employee_id')->unsigned()->index()->after('user_id')->nullable();
            } else {
                $table->integer('employee_id')->unsigned()->index()->after('user_id')->nullable();
            }
            $table->foreign('employee_id')->references('id')->on('users');
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
            $table->dropColumn('employee_id');
        });
    }
}
