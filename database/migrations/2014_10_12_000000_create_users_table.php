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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('people_card')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('city')->nullable();
            $table->string('username')->unique()->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('referral_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**Nama, Jenis Kelamin, No KTP, No HP, Email, Kota, Kode Referal
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
