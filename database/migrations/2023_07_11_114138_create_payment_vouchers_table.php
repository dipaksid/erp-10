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
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('companyid')->nullable()->default(null)->index();
            $table->char('paymentcode',30)->default('')->index();
            $table->date('paymentdate')->nullable();
            $table->integer('supplierid')->nullable()->index();
            $table->char('suppliername',100)->default('');
            $table->char('referenceno',60)->nullable();
            $table->date('referencedate')->nullable();
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('amount',11,2)->default('0.00');
            $table->json('description')->nullable();
            $table->json('sup_inv_no')->nullable()->default(null);
            $table->json('sup_inv_dat')->nullable()->default(null);
            $table->timestamps();
            $table->dateTime('cancelled_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('payment_vouchers');
    }
};
