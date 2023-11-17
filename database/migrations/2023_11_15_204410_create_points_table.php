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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->integer('min_points');
            $table->string('reward')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('point_type', ['multiple', 'one_time'])->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->boolean('converted')->default(false);
            $table->timestamps();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
