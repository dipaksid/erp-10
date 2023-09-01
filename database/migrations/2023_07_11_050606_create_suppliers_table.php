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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->char('supplierid',200)->default('')->index();
            $table->char('companycode',20)->default('');
            $table->char('companyname',100)->default('');
            $table->char('companyname2',100)->default('');
            $table->char('registrationno',30)->default('');
            $table->char('registrationno2',30)->default('');
            $table->char('address1',50)->default('');
            $table->char('address2',50)->default('');
            $table->char('address3',50)->default('');
            $table->char('address4',50)->default('');
            $table->char('contactperson',60)->default('');
            $table->char('phoneno1',30)->default('');
            $table->char('phoneno2',30)->default('');
            $table->char('faxno1',30)->default('');
            $table->char('faxno2',30)->default('');
            $table->char('email',100)->default('');
            $table->char('email2',100)->default('')->nullable();
            $table->char('homepage',100)->default('');
            $table->char('businessnature',100)->default('');
            $table->decimal('creditlimit',19,2)->default(0.00);
            $table->integer('currentbalance')->default(0);
            $table->date('startdate')->nullable();
            $table->char('status',10)->default('');
            $table->char('gstregno',20)->default('');
            $table->char('zipcode',20)->default('');
            $table->char('bandar',20)->default('');
            $table->foreignId('areas_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currencies_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('terms_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('suppliers');
    }
};
