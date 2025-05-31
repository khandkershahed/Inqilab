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
        Schema::create('epapers', function (Blueprint $table) {
            $table->id();
            $table->string('epaper_name')->nullable();
            $table->string('slug')->unique();
            $table->string('epaper_title')->nullable();
            $table->date('post_date')->nullable();
            $table->string('epaper_image')->nullable();
            $table->string('epaper_image_alt')->nullable();
            $table->string('epaper_image_url')->nullable();
            $table->string('language', 10)->default('en')->nullable();
            $table->unsignedInteger('page_number')->nullable();
            $table->unsignedInteger('total_pages')->default(1)->nullable();
            $table->string('epaper_pdf_url')->nullable();
            $table->string('epaper_category')->nullable();
            $table->text('tags')->nullable();
            $table->string('published_by')->nullable();
            $table->string('region')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epapers');
    }
};
