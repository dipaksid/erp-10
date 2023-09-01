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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->char('purchaseorderid',200)->index();
            $table->char('purchaseordercode',30)->default('')->index();
            $table->date('purchaseorderdate')->nullable();
            $table->integer('supplierid')->nullable()->index();
            $table->char('suppliername',100)->default('');
            $table->char('attention',100)->default('');
            $table->char('phone',30)->default('');
            $table->char('fax',30)->default('');
            $table->char('referenceno',60)->nullable();
            $table->foreignId('terms_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('title',30)->nullable('');
            $table->char('duedate',30)->nullable('');
            $table->char('address1',50)->default('');
            $table->char('address2',50)->default('');
            $table->char('address3',50)->default('');
            $table->char('address4',50)->default('');
            $table->char('deliveraddress1',50)->default('');
            $table->char('deliveraddress2',50)->default('');
            $table->char('deliveraddress3',50)->default('');
            $table->char('deliveraddress4',50)->default('');
            $table->char('delivercontact',100)->default('');
            $table->char('deliverphone',30)->default('');
            $table->char('deliverfax',30)->default('');
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('totalamount',11,2)->default('0.00');
            $table->decimal('subtotalamount',11,2)->default('0.00');
            $table->decimal('taxtotalamount',11,2)->default('0.00');
            $table->decimal('nettotalamount',11,2)->default('0.00');
            $table->decimal('roundingadjustment',11,2)->default('0.00');
            $table->boolean('iscancelled')->default(0);
            $table->boolean('isclosed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('purchase_orders');
    }
};
