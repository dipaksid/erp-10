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
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->id();
            $table->char("groupcode",100)->default('')->index();
            $table->string('description',191);
            $table->foreignId('customer_categories_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('companyid')->index();
            $table->char("foldername",200)->default('')->nullable()->default(null);
            $table->char("serial_no",20)->default('');
            $table->char("exp_dat",10)->default('');
            $table->char("cfgpassword",20)->default('');
            $table->foreignId('agents_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char("cfgfile",100);
            $table->integer('soft_lic')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_groups');
    }
};
