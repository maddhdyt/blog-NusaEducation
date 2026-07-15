<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->string('theme_primary_color')->nullable()->after('site_logo_url');
            $table->string('theme_primary_strong_color')->nullable()->after('theme_primary_color');
            $table->string('theme_primary_soft_color')->nullable()->after('theme_primary_strong_color');
            $table->string('theme_background_color')->nullable()->after('theme_primary_soft_color');
            $table->string('theme_card_color')->nullable()->after('theme_background_color');
            $table->string('theme_text_color')->nullable()->after('theme_card_color');
            $table->string('theme_text_muted_color')->nullable()->after('theme_text_color');
            $table->string('theme_border_color')->nullable()->after('theme_text_muted_color');
        });
    }

    public function down(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->dropColumn([
                'theme_primary_color',
                'theme_primary_strong_color',
                'theme_primary_soft_color',
                'theme_background_color',
                'theme_card_color',
                'theme_text_color',
                'theme_text_muted_color',
                'theme_border_color',
            ]);
        });
    }
};
