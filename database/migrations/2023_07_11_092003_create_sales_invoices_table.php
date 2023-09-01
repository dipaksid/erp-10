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
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('companyid')->nullable()->default(null)->index();
            $table->char('salesinvoiceid',200)->default('');
            $table->char('salesinvoicecode',30)->default('');
            $table->date('salesinvoicedate')->nullable();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('customername',100)->default('');
            $table->char('attention',100)->default('');
            $table->char('phone',30)->default('');
            $table->char('fax',30)->default('');
            $table->char('address1',50)->default('');
            $table->char('address2',50)->default('');
            $table->char('address3',50)->default('');
            $table->char('address4',50)->default('');
            $table->char('referenceno',60)->nullable();
            $table->foreignId('agents_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('docontact',100)->default('');
            $table->char('dophone',30)->default('');
            $table->char('dofax',30)->default('');
            $table->char('doaddress1',50)->default('');
            $table->char('doaddress2',50)->default('');
            $table->char('doaddress3',50)->default('');
            $table->char('doaddress4',50)->default('');
            $table->char('doregistationno',30)->default('');
            $table->char('dogstregno',30)->default('');
            $table->char('dophone2',30)->default('');
            $table->char('doemail',50)->default('');
            $table->char('doremark',100)->default('');
            $table->foreignId('areas_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('terms_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('totalamount',11,2)->default('0.00');
            $table->decimal('discountamount',11,2)->default('0.00');
            $table->decimal('subtotalamount',11,2)->default('0.00');
            $table->decimal('taxtotalamount',11,2)->default('0.00');
            $table->decimal('nettotalamount',11,2)->default('0.00');
            $table->decimal('roundingadjustment',11,2)->default('0.00');
            $table->text('sales_note')->nullable()->default(null);
            $table->dateTime('cancelled_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('sales_invoices');
    }
};
