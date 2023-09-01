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
        Schema::create('customer_pkpbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->nullable()->default(null)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('serviceid')->nullable()->default(null);
            $table->char('nam',60);
            $table->char('ic_no',20);
            $table->char('pho_no',20);
            $table->char('suhu',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_pkpbs');
    }
};
