<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SidebarSetting extends Model
{
    protected $fillable = [
        'site_logo_url',
        'theme_primary_color',
        'theme_primary_strong_color',
        'theme_primary_soft_color',
        'theme_background_color',
        'theme_card_color',
        'theme_text_color',
        'theme_text_muted_color',
        'theme_border_color',
        'footer_description',
        'footer_facebook_url',
        'footer_instagram_url',
        'footer_x_url',
        'footer_github_url',
        'footer_youtube_url',
        'author_name',
        'author_role',
        'author_avatar_url',
        'author_bio',
        'author_tiktok_url',
        'author_youtube_url',
        'author_newsletter_url',
        'trending_title',
        'trending_link_text',
        'trending_link_url',
        'cta_badge',
        'cta_title',
        'cta_subtitle',
        'cta_primary_text',
        'cta_primary_url',
        'cta_secondary_text',
        'cta_secondary_url',
    ];
}
