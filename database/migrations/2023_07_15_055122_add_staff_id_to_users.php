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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('staff_id')->after('password')->nullable()->default(null);
            $table->char('api_token',80)->after('staff_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_staff_id_foreign');
            $table->dropIndex('users_staff_id_foreign');
            $table->dropColumn('staff_id');
            $table->dropColumn('api_token');
        });
    }
};
