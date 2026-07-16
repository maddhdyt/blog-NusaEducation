@extends('layouts.admin')

@section('page_title', 'Sidebar Settings')

@section('content')
    <div class="w-full">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Sidebar Settings</h2>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-[#0a1435] border border-[#0a1435] text-white text-sm font-bold uppercase tracking-wider hover:bg-[#FDF6F0] hover:text-[#0a1435] transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                View Site
            </a>
        </div>

        <div class="card bg-white p-0">
            <form action="{{ route('admin.sidebar-settings.update') }}" method="POST" class="divide-y divide-[#0a1435]" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Logo -->
                <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-white">
                    <div class="lg:col-span-1">
                        <h2 class="text-lg font-bold uppercase tracking-wider text-[#0a1435]">Logo & Identitas</h2>
                        <p class="text-sm font-semibold text-[#0a1435]/70 mt-2">Atur logo utama yang ditampilkan pada website.</p>
                    </div>
                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="site_logo_url">Logo URL</label>
                            <input type="url" name="site_logo_url" id="site_logo_url" class="form-input" value="{{ old('site_logo_url', optional($setting)->site_logo_url ?: 'https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto') }}" placeholder="https://...">
                        </div>
                        <div>
                            <label class="form-label" for="site_logo">Upload Logo Lokal</label>
                            <input type="file" name="site_logo" id="site_logo" class="form-input bg-white p-1.5" accept="image/*">
                            @php
                                $activeLogo = optional($setting)->site_logo_url ?: 'https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto';
                            @endphp
                            <p class="text-xs font-bold text-[#0a1435] mt-2">Saat ini: <a href="{{ $activeLogo }}" class="text-blue-600 underline" target="_blank">Lihat Logo</a></p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-[#FDF6F0]">
                    <div class="lg:col-span-1">
                        <h2 class="text-lg font-bold uppercase tracking-wider text-[#0a1435]">Footer</h2>
                        <p class="text-sm font-semibold text-[#0a1435]/70 mt-2">Deskripsi singkat dan tautan media sosial untuk bagian bawah web.</p>
                    </div>
                    <div class="lg:col-span-2 space-y-4">
                        <div>
                            <label class="form-label" for="footer_description">Deskripsi Singkat</label>
                            <textarea name="footer_description" id="footer_description" rows="3" class="form-input">{{ old('footer_description', optional($setting)->footer_description) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="footer_facebook_url">Facebook URL</label>
                                <input type="url" name="footer_facebook_url" id="footer_facebook_url" class="form-input" value="{{ old('footer_facebook_url', optional($setting)->footer_facebook_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_instagram_url">Instagram URL</label>
                                <input type="url" name="footer_instagram_url" id="footer_instagram_url" class="form-input" value="{{ old('footer_instagram_url', optional($setting)->footer_instagram_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_x_url">X (Twitter) URL</label>
                                <input type="url" name="footer_x_url" id="footer_x_url" class="form-input" value="{{ old('footer_x_url', optional($setting)->footer_x_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_github_url">GitHub URL</label>
                                <input type="url" name="footer_github_url" id="footer_github_url" class="form-input" value="{{ old('footer_github_url', optional($setting)->footer_github_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="footer_youtube_url">YouTube URL</label>
                                <input type="url" name="footer_youtube_url" id="footer_youtube_url" class="form-input" value="{{ old('footer_youtube_url', optional($setting)->footer_youtube_url) }}">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Profil Penulis -->
                <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-[#FDF6F0]">
                    <div class="lg:col-span-1">
                        <h2 class="text-lg font-bold uppercase tracking-wider text-[#0a1435]">Profil Penulis</h2>
                        <p class="text-sm font-semibold text-[#0a1435]/70 mt-2">Informasi pembuat atau pemilik blog yang muncul di area sidebar.</p>
                    </div>
                    <div class="lg:col-span-2 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="author_name">Nama</label>
                                <input type="text" name="author_name" id="author_name" class="form-input" value="{{ old('author_name', optional($setting)->author_name) }}">
                            </div>
                            <div>
                                <label class="form-label" for="author_role">Peran</label>
                                <input type="text" name="author_role" id="author_role" class="form-input" value="{{ old('author_role', optional($setting)->author_role) }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="author_avatar_url">Avatar URL</label>
                                <input type="url" name="author_avatar_url" id="author_avatar_url" class="form-input" value="{{ old('author_avatar_url', optional($setting)->author_avatar_url) }}" placeholder="https://...">
                            </div>
                            <div>
                                <label class="form-label" for="author_avatar">Upload Avatar Lokal</label>
                                <input type="file" name="author_avatar" id="author_avatar" class="form-input bg-white p-1.5" accept="image/*">
                                @if (optional($setting)->author_avatar_url)
                                    <p class="text-xs font-bold text-[#0a1435] mt-2">Saat ini: <a href="{{ optional($setting)->author_avatar_url }}" class="text-blue-600 underline" target="_blank">Lihat Avatar</a></p>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="author_bio">Bio Singkat</label>
                            <textarea name="author_bio" id="author_bio" rows="3" class="form-input">{{ old('author_bio', optional($setting)->author_bio) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="form-label" for="author_tiktok_url">TikTok URL</label>
                                <input type="url" name="author_tiktok_url" id="author_tiktok_url" class="form-input" value="{{ old('author_tiktok_url', optional($setting)->author_tiktok_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="author_youtube_url">YouTube URL</label>
                                <input type="url" name="author_youtube_url" id="author_youtube_url" class="form-input" value="{{ old('author_youtube_url', optional($setting)->author_youtube_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="author_newsletter_url">Newsletter URL</label>
                                <input type="url" name="author_newsletter_url" id="author_newsletter_url" class="form-input" value="{{ old('author_newsletter_url', optional($setting)->author_newsletter_url) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-white">
                    <div class="lg:col-span-1">
                        <h2 class="text-lg font-bold uppercase tracking-wider text-[#0a1435]">Banner Promosi (CTA)</h2>
                        <p class="text-sm font-semibold text-[#0a1435]/70 mt-2">Atur tombol ajakan bertindak (Call to Action) di sidebar.</p>
                    </div>
                    <div class="lg:col-span-2 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="cta_badge">Badge Teks</label>
                                <input type="text" name="cta_badge" id="cta_badge" class="form-input" value="{{ old('cta_badge', optional($setting)->cta_badge) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_title">Judul Utama</label>
                                <input type="text" name="cta_title" id="cta_title" class="form-input" value="{{ old('cta_title', optional($setting)->cta_title) }}">
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="cta_subtitle">Deskripsi Tambahan</label>
                            <textarea name="cta_subtitle" id="cta_subtitle" rows="3" class="form-input">{{ old('cta_subtitle', optional($setting)->cta_subtitle) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label" for="cta_primary_text">Tombol Utama Teks</label>
                                <input type="text" name="cta_primary_text" id="cta_primary_text" class="form-input" value="{{ old('cta_primary_text', optional($setting)->cta_primary_text) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_primary_url">Tombol Utama URL</label>
                                <input type="url" name="cta_primary_url" id="cta_primary_url" class="form-input" value="{{ old('cta_primary_url', optional($setting)->cta_primary_url) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_secondary_text">Tombol Sekunder Teks</label>
                                <input type="text" name="cta_secondary_text" id="cta_secondary_text" class="form-input" value="{{ old('cta_secondary_text', optional($setting)->cta_secondary_text) }}">
                            </div>
                            <div>
                                <label class="form-label" for="cta_secondary_url">Tombol Sekunder URL</label>
                                <input type="url" name="cta_secondary_url" id="cta_secondary_url" class="form-input" value="{{ old('cta_secondary_url', optional($setting)->cta_secondary_url) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trending -->
                <div class="p-6 md:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-[#FDF6F0]">
                    <div class="lg:col-span-1">
                        <h2 class="text-lg font-bold uppercase tracking-wider text-[#0a1435]">Sedang Tren</h2>
                        <p class="text-sm font-semibold text-[#0a1435]/70 mt-2">Widget untuk tautan cepat ke topik populer.</p>
                    </div>
                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label" for="trending_title">Judul Blok</label>
                            <input type="text" name="trending_title" id="trending_title" class="form-input" value="{{ old('trending_title', optional($setting)->trending_title) }}">
                        </div>
                        <div>
                            <label class="form-label" for="trending_link_text">Teks Tautan Tambahan</label>
                            <input type="text" name="trending_link_text" id="trending_link_text" class="form-input" value="{{ old('trending_link_text', optional($setting)->trending_link_text) }}">
                        </div>
                        <div>
                            <label class="form-label" for="trending_link_url">URL Tautan</label>
                            <input type="url" name="trending_link_url" id="trending_link_url" class="form-input" value="{{ old('trending_link_url', optional($setting)->trending_link_url) }}">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="p-6 md:p-8 bg-white flex items-center justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

