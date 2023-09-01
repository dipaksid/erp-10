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
        Schema::create('good_receives', function (Blueprint $table) {
            $table->id();
            $table->char('purchaseorderid',200)->index()->nullable()->default(null);
            $table->unsignedInteger('warrantyid')->index()->nullable()->default(null);
            $table->foreignId('stocks_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char(20);
            $table->date('sup_inv_dat')->nullable()->default(null);
            $table->unsignedInteger('rcv_qty')->default(0);
            $table->decimal('rcv_price',10,2)->default(0.00);
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
