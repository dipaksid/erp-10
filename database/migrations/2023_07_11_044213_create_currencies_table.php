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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char("currencycode",20)->default('');
            $table->string("description",200)->default('');
            $table->char("sign",5)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('currencies');
    }
};
