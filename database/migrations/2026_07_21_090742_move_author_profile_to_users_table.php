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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_url')->nullable()->after('password');
            $table->string('role_title')->nullable()->after('avatar_url');
            $table->text('bio')->nullable()->after('role_title');
            $table->string('tiktok_url')->nullable()->after('bio');
            $table->string('youtube_url')->nullable()->after('tiktok_url');
            $table->string('newsletter_url')->nullable()->after('youtube_url');
        });

        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->dropColumn([
                'author_name',
                'author_role',
                'author_avatar_url',
                'author_bio',
                'author_tiktok_url',
                'author_youtube_url',
                'author_newsletter_url',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->string('author_name')->nullable();
            $table->string('author_role')->nullable();
            $table->string('author_avatar_url')->nullable();
            $table->text('author_bio')->nullable();
            $table->string('author_tiktok_url')->nullable();
            $table->string('author_youtube_url')->nullable();
            $table->string('author_newsletter_url')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar_url',
                'role_title',
                'bio',
                'tiktok_url',
                'youtube_url',
                'newsletter_url',
            ]);
        });
    }
};
