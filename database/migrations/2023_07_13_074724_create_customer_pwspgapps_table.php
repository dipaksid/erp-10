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
        Schema::create('customer_pwspgapps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customers_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->char('apiurl',255);
            $table->char('client_id',80);
            $table->char('client_secret',80);
            $table->char('username',200);
            $table->char('password',200);
            $table->char('active',1)->nullable()->default(null);
            $table->char('last_token',40);
            $table->dateTime('token_dt')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_pwspgapps');
    }
};
