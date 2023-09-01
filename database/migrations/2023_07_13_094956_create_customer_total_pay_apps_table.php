<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_total_pay_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_services_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('shopname',255);
            $table->char('contactno',20);
            $table->char('apiurl',255);
            $table->char('tapiurl',50);
            $table->char('client_id',80);
            $table->char('client_secret',80);
            $table->char('username',200);
            $table->char('password',200);
            $table->integer('renew_red')->default(0);
            $table->integer('b_reduce_principle')->default(0);
            $table->integer('b_acpt_op')->nullable()->default(0);
            $table->integer('b_dealforyou')->nullable()->default(0);
            $table->integer('b_locate')->nullable()->default(0);
            $table->integer('b_getgprc')->nullable()->default(0);
            $table->integer('b_floating')->nullable()->default(0);
            $table->integer('b_payslip')->nullable()->default(0);
            $table->integer('b_productimage')->nullable()->default(0);
            $table->integer('b_refer')->nullable()->default(0);
            $table->char('merchant_code',200)->nullable();
            $table->char('merchant_key',200)->nullable();
            $table->char('active',1)->nullable()->default(0);
            $table->char('qrpdfurl',250);
            $table->decimal('chrg_amt',11,2)->nullable()->default(null);
            $table->decimal('cust_chrg_amt',11,2)->nullable()->default(null);
            $table->char('slogan',200)->nullable();
            $table->char('email',100)->nullable()->default(null);
            $table->text('map_address')->nullable()->default(null);
            $table->char('latitude',100);
            $table->char('longitude',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_total_pay_apps');
    }
};
