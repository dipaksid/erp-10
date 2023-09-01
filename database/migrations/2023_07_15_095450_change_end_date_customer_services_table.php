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
        Schema::table('customer_services', function (Blueprint $table) {
            $table->string('start_date',50)->nullable()->change();
            $table->string('end_date',50)->nullable()->change();
            $table->string('service_date',50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_services', function (Blueprint $table) {
            //Nothing to change
        });
    }
};
