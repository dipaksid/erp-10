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
        Schema::table('customers', function (Blueprint $table) {
            $table->char('address2', 50)->nullable()->default(null)->change();
            $table->char('address3', 50)->nullable()->default(null)->change();
            $table->char('address4', 50)->nullable()->default(null)->change();
            $table->char('phoneno2', 50)->nullable()->default(null)->change();
            $table->char('faxno1', 50)->nullable()->default(null)->change();
            $table->char('faxno2', 50)->nullable()->default(null)->change();
            $table->char('email2', 50)->nullable()->default(null)->change();
            $table->char('email3', 50)->nullable()->default(null)->change();
            $table->char('homepage', 50)->nullable()->default(null)->change();
            $table->char('status', 50)->nullable()->default(null)->change();
            $table->char('gstregno', 50)->nullable()->default(null)->change();
            $table->char('zipcode', 50)->nullable()->default(null)->change();
            $table->char('email', 50)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
