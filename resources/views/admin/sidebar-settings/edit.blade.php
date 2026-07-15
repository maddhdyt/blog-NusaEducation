@extends('layouts.admin')

@section('page_title', 'Sidebar Settings')

@section('content')
    <div class="max-w-5xl">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Sidebar Settings</h1>
            <a href="{{ route('home') }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View Site ↗</a>
        </div>

        <div class="card p-6 space-y-6">
            <form action="{{ route('admin.sidebar-settings.update') }}" method="POST" class="space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-gray-900">Logo</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-end">
                            <div>
                                <label class="form-label" for="site_logo_url">Logo URL</label>
                                <input type="url" name="site_logo_url" id="site_logo_url" class="form-input"
                                    value="{{ old('site_logo_url', optional($setting)->site_logo_url) }}"
                                    placeholder="https://...">
                            </div>
                            <div>
                                <label class="form-label" for="site_logo">Upload Logo</label>
                                <input type="file" name="site_logo" id="site_logo" class="form-input" accept="image/*">
                                @if (optional($setting)->site_logo_url)
                                    <p class="text-xs text-gray-500 mt-1">Saat ini:
                                        <a href="{{ optional($setting)->site_logo_url }}" class="text-blue-600"
                                            target="_blank">Lihat</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-gray-900">Footer</h2>
                        <div>
                            <label class="form-label" for="footer_description">Deskripsi</label>
                            <textarea name="footer_description" id="footer_description" rows="3" class="form-input">{{ old('footer_description', optional($setting)->footer_description) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="form-label" for="footer_facebook_url">Facebook URL</label>
                                <input type="url" name="footer_facebook_url" id="footer_facebook_url" class="form-input"
                                    value="{{ old('footer_facebook_url', optional($setting)->footer_facebook_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_instagram_url">Instagram URL</label>
                                <input type="url" name="footer_instagram_url" id="footer_instagram_url"
                                    class="form-input"
                                    value="{{ old('footer_instagram_url', optional($setting)->footer_instagram_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_x_url">X (Twitter) URL</label>
                                <input type="url" name="footer_x_url" id="footer_x_url" class="form-input"
                                    value="{{ old('footer_x_url', optional($setting)->footer_x_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_github_url">GitHub URL</label>
                                <input type="url" name="footer_github_url" id="footer_github_url" class="form-input"
                                    value="{{ old('footer_github_url', optional($setting)->footer_github_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_youtube_url">YouTube URL</label>
                                <input type="url" name="footer_youtube_url" id="footer_youtube_url" class="form-input"
                                    value="{{ old('footer_youtube_url', optional($setting)->footer_youtube_url) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-gray-900">Tema</h2>
                        <p class="text-sm text-gray-600">Atur warna utama situs. Gunakan preset untuk cepat, atau sesuaikan
                            manual.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-end">
                            <div>
                                <label class="form-label" for="theme_preset">Preset</label>
                                <select id="theme_preset" class="form-input">
                                    <option value="custom" selected>Custom</option>
                                    <option value="indigo">Indigo Modern</option>
                                    <option value="emerald">Emerald Soft</option>
                                    <option value="amber">Amber Warm</option>
                                    <option value="slate">Slate Minimal</option>
                                </select>
                            </div>
                            <button type="button" id="apply_theme_preset" class="btn-secondary h-10 mt-6 sm:mt-0">Terapkan
                                preset</button>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="form-label" for="theme_primary_color">Primary</label>
                                <input type="color" name="theme_primary_color" id="theme_primary_color"
                                    class="form-input"
                                    value="{{ old('theme_primary_color', optional($setting)->theme_primary_color ?? '#4f46e5') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_primary_strong_color">Primary Hover</label>
                                <input type="color" name="theme_primary_strong_color" id="theme_primary_strong_color"
                                    class="form-input"
                                    value="{{ old('theme_primary_strong_color', optional($setting)->theme_primary_strong_color ?? '#4338ca') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_primary_soft_color">Primary Soft</label>
                                <input type="color" name="theme_primary_soft_color" id="theme_primary_soft_color"
                                    class="form-input"
                                    value="{{ old('theme_primary_soft_color', optional($setting)->theme_primary_soft_color ?? '#eef2ff') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_background_color">Background</label>
                                <input type="color" name="theme_background_color" id="theme_background_color"
                                    class="form-input"
                                    value="{{ old('theme_background_color', optional($setting)->theme_background_color ?? '#f9fafb') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_card_color">Card</label>
                                <input type="color" name="theme_card_color" id="theme_card_color" class="form-input"
                                    value="{{ old('theme_card_color', optional($setting)->theme_card_color ?? '#ffffff') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_border_color">Border</label>
                                <input type="color" name="theme_border_color" id="theme_border_color"
                                    class="form-input"
                                    value="{{ old('theme_border_color', optional($setting)->theme_border_color ?? '#e5e7eb') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_text_color">Teks</label>
                                <input type="color" name="theme_text_color" id="theme_text_color" class="form-input"
                                    value="{{ old('theme_text_color', optional($setting)->theme_text_color ?? '#111827') }}">
                            </div>
                            <div>
                                <label class="form-label" for="theme_text_muted_color">Teks Sekunder</label>
                                <input type="color" name="theme_text_muted_color" id="theme_text_muted_color"
                                    class="form-input"
                                    value="{{ old('theme_text_muted_color', optional($setting)->theme_text_muted_color ?? '#4b5563') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-gray-900">Profil Penulis</h2>
                        <div>
                            <label class="form-label" for="author_name">Nama</label>
                            <input type="text" name="author_name" id="author_name" class="form-input"
                                value="{{ old('author_name', optional($setting)->author_name) }}">
                        </div>
                        <div>
                            <label class="form-label" for="author_role">Peran</label>
                            <input type="text" name="author_role" id="author_role" class="form-input"
                                value="{{ old('author_role', optional($setting)->author_role) }}">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-end">
                            <div>
                                <label class="form-label" for="author_avatar_url">Avatar URL</label>
                                <input type="url" name="author_avatar_url" id="author_avatar_url" class="form-input"
                                    value="{{ old('author_avatar_url', optional($setting)->author_avatar_url) }}"
                                    placeholder="https://...">
                            </div>
                            <div>
                                <label class="form-label" for="author_avatar">Upload Avatar</label>
                                <input type="file" name="author_avatar" id="author_avatar" class="form-input"
                                    accept="image/*">
                                @if (optional($setting)->author_avatar_url)
                                    <p class="text-xs text-gray-500 mt-1">Saat ini:
                                        <a href="{{ optional($setting)->author_avatar_url }}" class="text-blue-600"
                                            target="_blank">Lihat</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="author_bio">Bio</label>
                            <textarea name="author_bio" id="author_bio" rows="3" class="form-input">{{ old('author_bio', optional($setting)->author_bio) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="form-label" for="author_tiktok_url">TikTok URL</label>
                                <input type="url" name="author_tiktok_url" id="author_tiktok_url" class="form-input"
                                    value="{{ old('author_tiktok_url', optional($setting)->author_tiktok_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="author_youtube_url">YouTube URL</label>
                                <input type="url" name="author_youtube_url" id="author_youtube_url"
                                    class="form-input"
                                    value="{{ old('author_youtube_url', optional($setting)->author_youtube_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="author_newsletter_url">Newsletter URL</label>
                                <input type="url" name="author_newsletter_url" id="author_newsletter_url"
                                    class="form-input"
                                    value="{{ old('author_newsletter_url', optional($setting)->author_newsletter_url) }}">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-gray-900">CTA</h2>
                        <div>
                            <label class="form-label" for="cta_badge">Badge</label>
                            <input type="text" name="cta_badge" id="cta_badge" class="form-input"
                                value="{{ old('cta_badge', optional($setting)->cta_badge) }}">
                        </div>
                        <div>
                            <label class="form-label" for="cta_title">Judul</label>
                            <input type="text" name="cta_title" id="cta_title" class="form-input"
                                value="{{ old('cta_title', optional($setting)->cta_title) }}">
                        </div>
                        <div>
                            <label class="form-label" for="cta_subtitle">Deskripsi</label>
                            <textarea name="cta_subtitle" id="cta_subtitle" rows="3" class="form-input">{{ old('cta_subtitle', optional($setting)->cta_subtitle) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="form-label" for="cta_primary_text">Tombol Utama Teks</label>
                                <input type="text" name="cta_primary_text" id="cta_primary_text" class="form-input"
                                    value="{{ old('cta_primary_text', optional($setting)->cta_primary_text) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_primary_url">Tombol Utama URL</label>
                                <input type="url" name="cta_primary_url" id="cta_primary_url" class="form-input"
                                    value="{{ old('cta_primary_url', optional($setting)->cta_primary_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_secondary_text">Tombol Sekunder Teks</label>
                                <input type="text" name="cta_secondary_text" id="cta_secondary_text"
                                    class="form-input"
                                    value="{{ old('cta_secondary_text', optional($setting)->cta_secondary_text) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_secondary_url">Tombol Sekunder URL</label>
                                <input type="url" name="cta_secondary_url" id="cta_secondary_url" class="form-input"
                                    value="{{ old('cta_secondary_url', optional($setting)->cta_secondary_url) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <h2 class="text-lg font-semibold text-gray-900">Sedang Tren</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="form-label" for="trending_title">Judul</label>
                            <input type="text" name="trending_title" id="trending_title" class="form-input"
                                value="{{ old('trending_title', optional($setting)->trending_title) }}">
                        </div>
                        <div>
                            <label class="form-label" for="trending_link_text">Teks Link</label>
                            <input type="text" name="trending_link_text" id="trending_link_text" class="form-input"
                                value="{{ old('trending_link_text', optional($setting)->trending_link_text) }}">
                        </div>
                        <div>
                            <label class="form-label" for="trending_link_url">URL Link</label>
                            <input type="url" name="trending_link_url" id="trending_link_url" class="form-input"
                                value="{{ old('trending_link_url', optional($setting)->trending_link_url) }}">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary">Simpan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const presets = {
                indigo: {
                    theme_primary_color: '#4f46e5',
                    theme_primary_strong_color: '#4338ca',
                    theme_primary_soft_color: '#eef2ff',
                    theme_background_color: '#f9fafb',
                    theme_card_color: '#ffffff',
                    theme_border_color: '#e5e7eb',
                    theme_text_color: '#111827',
                    theme_text_muted_color: '#4b5563',
                },
                emerald: {
                    theme_primary_color: '#10b981',
                    theme_primary_strong_color: '#059669',
                    theme_primary_soft_color: '#ecfdf3',
                    theme_background_color: '#f7fdf9',
                    theme_card_color: '#ffffff',
                    theme_border_color: '#e2f3eb',
                    theme_text_color: '#0f172a',
                    theme_text_muted_color: '#475569',
                },
                amber: {
                    theme_primary_color: '#f59e0b',
                    theme_primary_strong_color: '#d97706',
                    theme_primary_soft_color: '#fffbeb',
                    theme_background_color: '#fffdf7',
                    theme_card_color: '#ffffff',
                    theme_border_color: '#f4e7c3',
                    theme_text_color: '#1f2937',
                    theme_text_muted_color: '#4b5563',
                },
                slate: {
                    theme_primary_color: '#0f172a',
                    theme_primary_strong_color: '#0b1221',
                    theme_primary_soft_color: '#e2e8f0',
                    theme_background_color: '#f8fafc',
                    theme_card_color: '#ffffff',
                    theme_border_color: '#e2e8f0',
                    theme_text_color: '#0f172a',
                    theme_text_muted_color: '#475569',
                },
            };

            const presetSelect = document.getElementById('theme_preset');
            const applyBtn = document.getElementById('apply_theme_preset');
            const fields = [
                'theme_primary_color',
                'theme_primary_strong_color',
                'theme_primary_soft_color',
                'theme_background_color',
                'theme_card_color',
                'theme_border_color',
                'theme_text_color',
                'theme_text_muted_color',
            ];

            const applyPreset = (name) => {
                const preset = presets[name];
                if (!preset) return;
                fields.forEach((key) => {
                    const input = document.getElementById(key);
                    if (input && preset[key]) {
                        input.value = preset[key];
                    }
                });
            };

            applyBtn?.addEventListener('click', () => {
                const selected = presetSelect?.value;
                if (selected && selected !== 'custom') {
                    applyPreset(selected);
                }
            });
        });
    </script>
@endpush
