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
        Schema::create('customer_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_categories_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('contract_typ',1);
            $table->decimal('amount',11,2)->default(0.00);
            $table->char('inc_hw',1)->default('N');
            $table->char('pay_before',1)->default('N');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('service_date');
            $table->integer('soft_license')->default(0);
            $table->integer('pos_license')->default(0);
            $table->char('active',1)->default('N');
            $table->char('serial_no',20);
            $table->char('exp_dat',10);
            $table->char('cfgpassword',20);
            $table->foreignId('agents_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('cfgfile',100)->nullable()->default(null);
            $table->char('vpnaddress',100)->nullable()->default(null);
            $table->char('version',10);
            $table->char('rmk',70)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_services');
    }
};
