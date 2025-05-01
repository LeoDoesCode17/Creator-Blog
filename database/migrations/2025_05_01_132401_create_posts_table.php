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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //this is for title
            $table->string('content'); //this is for body
            $table->string('cover'); //this is for image cover
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); //this is for author id
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); //this is for category id
            $table->boolean('soft_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
