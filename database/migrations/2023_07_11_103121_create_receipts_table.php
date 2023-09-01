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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('companyid')->nullable()->default(null)->index();
            $table->char('receiptid',200)->default('');
            $table->char('receiptcode',30)->default('');
            $table->date('receiptdate')->nullable();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('customername',100)->default('');
            $table->string('description',250)->default('');
            $table->foreignId('banks_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('referenceno',60)->nullable();
            $table->foreignId('agents_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('bankcharges',11,2)->default('0.00');
            $table->decimal('totalamount',11,2)->default('0.00');
            $table->decimal('nettotalamount',11,2)->default('0.00');
            $table->integer('bankdoc_id')->nullable()->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('receipts');
    }
};
