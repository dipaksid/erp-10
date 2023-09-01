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
        Schema::create('customer_groups_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('customer_groups_id')->unsigned();
            $table->unsignedBiginteger('customers_id')->unsigned();
            $table->foreign('customer_groups_id')->references('id')
                ->on('customer_groups')->onDelete('cascade');
            $table->foreign('customers_id')->references('id')
                ->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_groups_customers');
    }
};
