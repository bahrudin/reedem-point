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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('author_id')->nullable();
            $table->string('title');
            $table->char('slug');
            $table->text('contents');
            $table->boolean('is_publish');
            $table->enum('point_type', ['multiple', 'one_time']);
            $table->foreignId('point_id');
            $table->foreignId('program_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('author_id')->references('id')->on('admins');
            $table->foreign('point_id')->references('id')->on('points');
            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
