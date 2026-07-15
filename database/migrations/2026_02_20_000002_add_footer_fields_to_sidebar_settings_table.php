<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->text('footer_description')->nullable()->after('site_logo_url');
            $table->string('footer_facebook_url')->nullable()->after('footer_description');
            $table->string('footer_instagram_url')->nullable()->after('footer_facebook_url');
            $table->string('footer_x_url')->nullable()->after('footer_instagram_url');
            $table->string('footer_github_url')->nullable()->after('footer_x_url');
            $table->string('footer_youtube_url')->nullable()->after('footer_github_url');
        });
    }

    public function down(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_description',
                'footer_facebook_url',
                'footer_instagram_url',
                'footer_x_url',
                'footer_github_url',
                'footer_youtube_url',
            ]);
        });
    }
};
