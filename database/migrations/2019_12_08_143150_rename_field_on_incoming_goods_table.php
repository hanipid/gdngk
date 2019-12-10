<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldOnIncomingGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incoming_goods', function (Blueprint $table) {
            $table->renameColumn('commodity_grades_id', 'commodity_grade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incoming_goods', function (Blueprint $table) {
            $table->renameColumn('commodity_grade_id', 'commodity_grades_id');
        });
    }
}
