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
        Schema::create('category_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_categories_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('version',10);
            $table->string('version_desc',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_versions');
    }
};
