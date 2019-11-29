<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdentities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik', 20)->nullable()->unique()->after('role_id');
            $table->string('company')->nullable()->after('password');
            $table->string('address')->nullable()->after('company');
            $table->string('phone', 20)->nullable()->after('address');
            $table->string('bank')->nullable()->after('phone');
            $table->string('bank_account')->nullable()->after('bank');
            $table->string('status')->nullable()->after('settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->dropColumn('company');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('bank');
            $table->dropColumn('bank_account');
            $table->dropColumn('status');
        });
    }
}
