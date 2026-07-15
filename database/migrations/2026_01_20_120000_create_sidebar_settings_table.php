<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sidebar_settings', function (Blueprint $table) {
            $table->id();
            // Author card
            $table->string('author_name')->nullable();
            $table->string('author_role')->nullable();
            $table->string('author_avatar_url')->nullable();
            $table->text('author_bio')->nullable();
            $table->string('author_tiktok_url')->nullable();
            $table->string('author_youtube_url')->nullable();
            $table->string('author_newsletter_url')->nullable();
            // Trending card
            $table->string('trending_title')->nullable();
            $table->string('trending_link_text')->nullable();
            $table->string('trending_link_url')->nullable();
            // CTA card
            $table->string('cta_badge')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_subtitle')->nullable();
            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sidebar_settings');
    }
};
