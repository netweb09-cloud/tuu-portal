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
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // Tiêu đề
            $table->string('slug')->unique(); // Đường dẫn bài viết
            $table->string('thumbnail')->nullable(); // Ảnh đại diện
            $table->longText('content'); // Nội dung bài viết
            $table->boolean('is_published')->default(false); // Trạng thái xuất bản
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
