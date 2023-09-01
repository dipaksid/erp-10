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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('companycode',20)->default('');
            $table->char('companyname',100)->default('');
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
            $table->char('email2',100)->default(null)->nullable();
            $table->char('email3',100)->default(null)->nullable();
            $table->char('homepage',100)->default('');
            $table->char('businessnature',100)->nullable()->default(null);
            $table->foreignId('customer_categories_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('areas_id')->nullable()->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sales_people_id')->nullable()->nullable()->constrained('sales_people')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currencies_id')->nullable()->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('terms_id')->nullable()->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('creditlimit',19,2)->default(0.00);
            $table->integer('currentbalance')->default(0);
            $table->date('startdate')->nullable();
            $table->char('status',15)->default('');
            $table->char('gstregno',20)->default('');
            $table->char('zipcode',20)->default('');
            $table->char('shortname',60);
            $table->char('foldername',60)->nullable()->default(null);
            $table->char('bandar',60);
            $table->char('b_aiservice',1)->default('N');
            $table->text('remarks')->nullable()->default(null);
            $table->text('serviceremarks')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customers');
    }
};
