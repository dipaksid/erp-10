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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('mob_pho')->nullable();
            $table->string('idle_tim')->nullable();
            $table->string('access_pdf')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('scope')->nullable();
            $table->string('sm_cod')->nullable();
            $table->string('email')->nullable();
            $table->string('prt_1')->nullable();
            $table->string('prt_2')->nullable();
            $table->string('client_id')->nullable();
            $table->string('alw_red')->nullable();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_detail');
    }
};
