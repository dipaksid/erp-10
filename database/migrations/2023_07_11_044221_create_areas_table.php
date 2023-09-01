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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('areas_id')->nullable()->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('areacode',20)->default('');
            $table->string('description',200)->default('');
            $table->char('auc_cod',5)->default('');
            $table->char('isactive',1)->default('0');
            $table->integer('seq')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('areas');
    }
};
