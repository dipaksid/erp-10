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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->char('companycode',20);
            $table->char('companyname',100);
            $table->char('registrationno',30)->nullable()->default(null);
            $table->char('registrationno2',30)->nullable()->default(null);
            $table->char('gstno',30)->nullable()->default(null);
            $table->char('address1',50)->nullable()->default(null);
            $table->char('address2',50)->nullable()->default(null);
            $table->char('address3',50)->nullable()->default(null);
            $table->char('address4',50)->nullable()->default(null);
            $table->foreignId('areas_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('zipcode',20)->nullable()->default(null);
            $table->char('city',60)->nullable()->default(null);
            $table->char('contactperson',60)->nullable()->default(null);
            $table->char('contactperson2',60)->nullable()->default(null);
            $table->char('phoneno1',30)->nullable()->default(null);
            $table->char('phoneno2',30)->nullable()->default(null);
            $table->char('email',100)->nullable()->default(null);
            $table->char('email2',100)->nullable()->default(null);
            $table->unsignedBigInteger('banks_id');
            $table->foreign('banks_id')->references('id')->on('banks');
            $table->unsignedBigInteger('banks_id2');
            $table->foreign('banks_id2')->references('id')->on('banks');
            $table->char('bankacc1',50)->nullable()->default(null);
            $table->char('bankacc2',50)->nullable()->default(null);
            $table->char('companyltrheader',30)->nullable()->default(null);
            $table->char('companyltrfooter',30)->nullable()->default(null);
            $table->char('b_default',1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
