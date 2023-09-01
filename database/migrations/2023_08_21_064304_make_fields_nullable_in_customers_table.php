<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsNullableInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('registrationno')->nullable()->change();
            $table->string('registrationno2')->nullable()->change();
            $table->string('contactperson')->nullable()->change();
            $table->string('phoneno1')->nullable()->change();
            $table->decimal('creditlimit', 10, 2)->nullable()->change();
            $table->decimal('currentbalance', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('registrationno')->nullable(false)->change();
            $table->string('registrationno2')->nullable(false)->change();
            $table->string('contactperson')->nullable(false)->change();
            $table->string('phoneno1')->nullable(false)->change();
            $table->decimal('creditlimit', 10, 2)->nullable(false)->change();
            $table->decimal('currentbalance', 10, 2)->nullable(false)->change();
        });
    }
}
