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
        Schema::table('leave_forms', function (Blueprint $table) {
            $table->string('leave_dat_frm',10)->nullable()->change();
            $table->string('leave_dat_to',10)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_forms', function (Blueprint $table) {
            //
        });
    }
};
