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
        Schema::create('authlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('requestauthdesc',250)->default('');
            $table->integer('requestbyid')->nullable();
            $table->integer('authorizedbyid')->nullable();
            $table->char('status',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('authlists');
    }
};
