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
        Schema::create('hardware_loans', function (Blueprint $table) {
            $table->id();
            $table->char('jobno',20);
            $table->foreignId('stocks_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('stockname',255)->nullable()->default(null);
            $table->string('remarks',255)->nullable();
            $table->char('comp_cod',255)->nullable()->default(null);
            $table->char('categorycode',255)->nullable()->default(null);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('hardware_loans');
    }
};
