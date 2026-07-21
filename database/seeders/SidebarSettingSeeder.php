<?php

namespace Database\Seeders;

use App\Models\SidebarSetting;
use Illuminate\Database\Seeder;

class SidebarSettingSeeder extends Seeder
{
    public function run(): void
    {
        SidebarSetting::query()->firstOrCreate([], [
            'site_logo_url' => null,
            'theme_primary_color' => '#4f46e5',
            'theme_primary_strong_color' => '#4338ca',
            'theme_primary_soft_color' => '#eef2ff',
            'theme_background_color' => '#f9fafb',
            'theme_card_color' => '#ffffff',
            'theme_text_color' => '#111827',
            'theme_text_muted_color' => '#4b5563',
            'theme_border_color' => '#e5e7eb',
            'footer_description' => 'ArkaSEO menghadirkan berita, tips, dan insight terbaru dunia crypto & blockchain.',
            'footer_facebook_url' => '#',
            'footer_instagram_url' => '#',
            'footer_x_url' => '#',
            'footer_github_url' => '#',
            'footer_youtube_url' => '#',
            'trending_title' => 'Sedang Tren',
            'trending_link_text' => 'Lihat semua',
            'trending_link_url' => '#',
            'cta_badge' => 'Mau Belajar',
            'cta_title' => 'Software Engineering',
            'cta_subtitle' => 'Dapatkan skill digital paling dicari bersama mentor praktisi dan komunitas pembelajar. Kelas online live, karier support, dan akses materi seumur hidup.',
            'cta_primary_text' => 'Daftar Full Program',
            'cta_primary_url' => '#',
            'cta_secondary_text' => 'Coba Dulu Gratis',
            'cta_secondary_url' => '#',
        ]);
    }
}
