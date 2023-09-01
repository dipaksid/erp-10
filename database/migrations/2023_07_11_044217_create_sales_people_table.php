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
        Schema::create('sales_people', function (Blueprint $table) {
            $table->id();
            $table->char("salespersonid",200)->default('')->index();
            $table->char("staffcode",20)->default('');
            $table->char("name",100)->default('');
            $table->char("idno",20)->default('');
            $table->date("datejoined")->nullable();
            $table->date("dateleft")->nullable();
            $table->char("mobileno",20)->default('');
            $table->char("email",100)->default('');
            $table->text("remarks")->nullable();
            $table->char("gender",1)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_people');
    }
};
