<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SidebarSettingController extends Controller
{
    public function edit()
    {
        $setting = SidebarSetting::first();

        return view('admin.sidebar-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_logo_url' => ['nullable', 'url'],
            'site_logo' => ['nullable', 'image', 'max:2048'],
            'theme_primary_color' => ['nullable', 'string', 'max:20'],
            'theme_primary_strong_color' => ['nullable', 'string', 'max:20'],
            'theme_primary_soft_color' => ['nullable', 'string', 'max:20'],
            'theme_background_color' => ['nullable', 'string', 'max:20'],
            'theme_card_color' => ['nullable', 'string', 'max:20'],
            'theme_text_color' => ['nullable', 'string', 'max:20'],
            'theme_text_muted_color' => ['nullable', 'string', 'max:20'],
            'theme_border_color' => ['nullable', 'string', 'max:20'],
            'footer_description' => ['nullable', 'string'],
            'footer_facebook_url' => ['nullable', 'url'],
            'footer_instagram_url' => ['nullable', 'url'],
            'footer_x_url' => ['nullable', 'url'],
            'footer_github_url' => ['nullable', 'url'],
            'footer_youtube_url' => ['nullable', 'url'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_role' => ['nullable', 'string', 'max:255'],
            'author_avatar_url' => ['nullable', 'url'],
            'author_avatar' => ['nullable', 'image', 'max:2048'],
            'author_bio' => ['nullable', 'string'],
            'author_tiktok_url' => ['nullable', 'url'],
            'author_youtube_url' => ['nullable', 'url'],
            'author_newsletter_url' => ['nullable', 'url'],
            'trending_title' => ['nullable', 'string', 'max:255'],
            'trending_link_text' => ['nullable', 'string', 'max:255'],
            'trending_link_url' => ['nullable', 'url'],
            'cta_badge' => ['nullable', 'string', 'max:255'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_subtitle' => ['nullable', 'string'],
            'cta_primary_text' => ['nullable', 'string', 'max:255'],
            'cta_primary_url' => ['nullable', 'url'],
            'cta_secondary_text' => ['nullable', 'string', 'max:255'],
            'cta_secondary_url' => ['nullable', 'url'],
        ]);

        $setting = SidebarSetting::first() ?? new SidebarSetting();

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('sidebar/logo', 'public');
            $data['site_logo_url'] = Storage::url($path);
        }

        if ($request->hasFile('author_avatar')) {
            $path = $request->file('author_avatar')->store('sidebar/avatars', 'public');
            $data['author_avatar_url'] = Storage::url($path);
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->route('admin.sidebar-settings.edit')->with('success', 'Sidebar settings updated.');
    }
}
