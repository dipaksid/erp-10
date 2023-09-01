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
        Schema::table('armatches', function (Blueprint $table) {
            $table->char('artype',20)->default('')->index()->change();
            $table->char('artranid',20)->default('')->index()->change();
            $table->char('payfortype',20)->default('')->index()->change();
            $table->char('payforid',20)->default('')->index()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('armatches', function (Blueprint $table) {
            //Not able to remove index using dropIndex() so empty
        });
    }
};
