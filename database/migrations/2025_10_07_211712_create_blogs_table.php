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
        Schema::create('blogs', function (Blueprint $table) {
            $table->string('blog_id');
            $table->string('category_id');
            $table->string('user_id');
            $table->integer('age');
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('pdf_file')->nullable();
            $table->longText('contents')->nullable();
            //author_claim, valid, invalid
            $table->string('role')->default('author_claim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
