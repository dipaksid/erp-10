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
        Schema::create('customer_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_categories_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char("categorycode",20)->default('');
            $table->string("description",191)->default('');
            $table->string('lastrunno',50);
            $table->char('version',10);
            $table->char('b_rmk',1)->default('N');
            $table->char('b_mobapp',1)->default('N');
            $table->char('b_adrmk',1)->default('N');
            $table->integer('stockcatgid')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_categories');
    }
};
