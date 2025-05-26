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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('author_id')->nullable()->index(); // references users table

            // Basic Info
            $table->text('title');
            $table->text('bangla_title')->nullable();
            $table->text('slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('bangla_summary')->nullable();

            // Main content
            $table->longText('content')->nullable();
            $table->longText('bangla_content')->nullable();

            // Media
            $table->string('thumbnail', 255)->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->string('video_url', 255)->nullable(); // YouTube, Vimeo, etc.

            // Metadata
            $table->string('tags')->nullable(); // comma-separated
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // News properties
            $table->enum('type', ['standard', 'breaking', 'feature', 'editorial'])->default('standard');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_most_read')->default(false);
            $table->boolean('is_breaking')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('show_in_slider')->default(false);
            $table->boolean('is_trending')->default(false);

            // Publication control
            $table->enum('status', ['draft', 'published', 'archived', 'unpublished'])->default('draft');
            $table->timestamp('published_at')->nullable();

            // Engagement metrics
            $table->string('author')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('share_count')->default(0);
            $table->unsignedInteger('comment_count')->default(0);

            // Audit fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            // Optional foreign keys (if needed)
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
