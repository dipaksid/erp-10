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
        Schema::create('arcns', function (Blueprint $table) {
            $table->id();
            $table->integer('companyid')->nullable()->default(null)->index();
            $table->char('arcnid',200)->default('')->index();
            $table->char('cncode',30)->default('');
            $table->date('cndate')->nullable();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('customername',250)->default('');
            $table->char('description',250)->default('');
            $table->char('reason',250)->nullable();
            $table->char('referenceno',60)->nullable();
            $table->foreignId('agents_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('totalamount',11,2)->default('0.00');
            $table->decimal('nettotalamount',11,2)->default('0.00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('arcns');
    }
};
