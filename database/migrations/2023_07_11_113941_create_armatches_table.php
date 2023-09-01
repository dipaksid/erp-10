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
        Schema::create('armatches', function (Blueprint $table) {
            $table->id();
            $table->char('artype',20)->default('');
            $table->integer('artranid')->nullable();
            $table->char('arcode',30)->default('');
            $table->char('payfortype',20)->default('');
            $table->integer('payforid')->nullable();
            $table->char('payforcode',30)->default('');
            $table->integer('arpos')->default(1);
            $table->char('description',250)->default('');
            $table->decimal('amount',11,2)->default('0.00')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armatches');
    }
};
