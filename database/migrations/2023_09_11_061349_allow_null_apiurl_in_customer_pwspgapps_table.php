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
        Schema::table('customer_pwspgapps', function (Blueprint $table) {
            // Make the apiurl column nullable
            $table->string('apiurl')->nullable()->change();
            $table->string('client_id')->nullable()->change();
            $table->string('client_secret')->nullable()->change();
            $table->string('last_token')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_pwspgapps', function (Blueprint $table) {
            $table->string('apiurl')->nullable(false)->change();
            $table->string('client_id')->nullable(false)->change();
            $table->string('client_secret')->nullable(false)->change();
            $table->string('last_token')->nullable(false)->change();
        });
    }
};
