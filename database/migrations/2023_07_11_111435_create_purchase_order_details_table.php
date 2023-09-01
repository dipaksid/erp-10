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
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('purchaseorderid')->index()->nullable()->default(null);
            $table->foreignId('stocks_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('pos')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('uomid')->nullable();
            $table->decimal('unitprice',11,2)->nullable();
            $table->char('description',250)->default('');
            $table->char('referenceno',250)->default('');
            $table->text('note')->nullable();
            $table->decimal('amount',11,2)->nullable();
            $table->decimal('discount',11,2)->nullable();
            $table->decimal('subamount',11,2)->nullable();
            $table->decimal('taxrate',11,2)->nullable();
            $table->decimal('taxamount',11,2)->nullable();
            $table->decimal('netamount',11,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('purchase_order_details');
    }
};
