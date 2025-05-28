<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('ad_type', ['image', 'html', 'video', 'script'])->default('image');
            $table->string('image_path')->nullable();
            $table->text('video_path')->nullable();
            $table->text('html_code')->nullable();
            $table->text('link')->nullable();
            $table->boolean('target_blank')->default(false);
            $table->string('position')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('priority')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'expired'])->default('approved');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->string('company_name')->nullable();
            $table->string('company_website')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
