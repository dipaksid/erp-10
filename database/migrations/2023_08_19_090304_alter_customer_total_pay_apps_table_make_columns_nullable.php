<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomerTotalPayAppsTableMakeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_total_pay_apps', function (Blueprint $table) {
            $table->string('apiurl')->nullable()->change();
            $table->string('tapiurl')->nullable()->change();
            $table->string('client_id')->nullable()->change();
            $table->string('client_secret')->nullable()->change();
            $table->string('username')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->string('qrpdfurl')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_total_pay_apps', function (Blueprint $table) {
            $table->string('apiurl')->nullable(false)->change();
            $table->string('tapiurl')->nullable(false)->change();
            $table->string('client_id')->nullable(false)->change();
            $table->string('client_secret')->nullable(false)->change();
            $table->string('username')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->string('qrpdfurl')->nullable(false)->change();
        });
    }
}
