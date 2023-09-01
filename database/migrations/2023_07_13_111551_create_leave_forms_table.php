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
        Schema::create('leave_forms', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no',100);
            $table->integer('staffid')->nullable()->default(null)->index();
            $table->string('staff_name',100)->nullable();
            $table->string('designation',40)->nullable();
            $table->string('leave_typ',100)->nullable();
            $table->decimal('leave_duration',10,2);
            $table->date('leave_dat_frm')->nullable();
            $table->date('leave_dat_to')->nullable();
            $table->string('leave_reason',100)->nullable();
            $table->string('applied_dat',10)->nullable();
            $table->integer('status')->default(2)->comment('1=approved,2=pending,0=reject');
            $table->string('approved_by',100)->nullable();
            $table->string('approved_dat',10)->nullable()->default(null);
            $table->string('applied_by',100);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_forms');
    }
};
