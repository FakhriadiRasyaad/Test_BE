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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('topics');
            $table->foreignId('language_id')->constrained('languages');
            $table->foreignId('created_by_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('short_description');
            $table->decimal('price', 18, 2);
            $table->decimal('discount_rate', 5, 2);
            $table->string('thumbnail_url');
            $table->enum('level', ['ALL LEVEL', 'BEGINNER', 'INTERMEDIATE', 'ADVANCE']);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
