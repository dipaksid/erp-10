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
        Schema::create('bankdocs', function (Blueprint $table) {
            $table->id();
            $table->char('bankdoc',20);
            $table->date('bankdoc_date')->nullable()->default(null);
            $table->foreignId('banks_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->json('receiptdetails')->nullable()->default(null);
            $table->string('remark',200);
            $table->integer('companyid')->nullable()->default(null);
            $table->decimal('totalamount',10,2)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankdocs');
    }
};
