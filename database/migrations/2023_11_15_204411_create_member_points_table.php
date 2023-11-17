<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_points', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('memberships_id');
//            $table->foreignId('article_id');
//            $table->integer('points');
//            $table->timestamps();
//
//            $table->foreign('memberships_id')->references('id')->on('memberships');
//            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreignId('program_id');
            $table->foreignId('point_id');
            $table->foreignId('user_id');
            $table->integer('amount_point');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('point_id')->references('id')->on('points');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_points');
    }
};
