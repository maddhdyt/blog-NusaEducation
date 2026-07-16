@php
    $sidebarSetting = \App\Models\SidebarSetting::first();
    $footerMenus = \App\Models\Menu::active()->parentOnly()->with('children')->orderBy('order')->get();
    $footerCategories = \App\Models\Category::withCount('publishedPosts')
        ->orderByDesc('published_posts_count')
        ->limit(5)
        ->get();
    $footerPosts = \App\Models\Post::published()->with('category')->latest('published_at')->limit(4)->get();
@endphp

<footer class="bg-[#FDF6F0] text-[#6b5b59] border-t border-[#e2d5cf] pt-12 mt-12 lg:mt-0">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-16">
        <div class="grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-4 space-y-6">
                <div class="inline-flex items-center">
                    <img src="https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto" alt="Nusa Education" class="h-16 w-auto mix-blend-multiply">
                </div>
                @php
                    $footerSocials = array_filter([
                        'facebook' => optional($sidebarSetting)->footer_facebook_url,
                        'instagram' => optional($sidebarSetting)->footer_instagram_url,
                        'x' => optional($sidebarSetting)->footer_x_url,
                        'github' => optional($sidebarSetting)->footer_github_url,
                        'youtube' => optional($sidebarSetting)->footer_youtube_url,
                    ]);
                @endphp
                <p class="text-[15px] text-[#6b5b59] max-w-md mt-4 leading-relaxed">
                    Mewujudkan visi Anda menjadi realita melalui perpaduan strategi, inovasi teknologi, dan desain digital yang terukur.
                </p>
                @if (!empty($footerSocials))
                    <div class="flex items-center gap-5 text-[#0a1435]">
                        @if (!empty($footerSocials['facebook']))
                            <a href="{{ $footerSocials['facebook'] }}" aria-label="Facebook"
                                class="hover:text-brand-primary transition" target="_blank" rel="noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                    fill="currentColor">
                                    <path
                                        d="M13.5 9H15V7h-1.5C12.12 7 11 8.12 11 9.5V11H9v2h2v5h2v-5h2l.5-2H13v-1.5c0-.28.22-.5.5-.5" />
                                </svg>
                            </a>
                        @endif
                        @if (!empty($footerSocials['instagram']))
                            <a href="{{ $footerSocials['instagram'] }}" aria-label="Instagram"
                                class="hover:text-brand-primary transition" target="_blank" rel="noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                    fill="currentColor">
                                    <path
                                        d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm10.25 1.5a.75.75 0 1 1-1.5 0a.75.75 0 0 1 1.5 0M12 8a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 2a2 2 0 1 0 0 4a2 2 0 0 0 0-4" />
                                </svg>
                            </a>
                        @endif
                        @if (!empty($footerSocials['x']))
                            <a href="{{ $footerSocials['x'] }}" aria-label="X" class="hover:text-brand-primary transition"
                                target="_blank" rel="noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                    fill="currentColor">
                                    <path d="m4 4h4.4l3.2 4.7L15 4h5l-6.2 7.5L20.5 20H16l-3.5-5L9 20H4.5l6-7.3z" />
                                </svg>
                            </a>
                        @endif
                        @if (!empty($footerSocials['github']))
                            <a href="{{ $footerSocials['github'] }}" aria-label="GitHub"
                                class="hover:text-brand-primary transition" target="_blank" rel="noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                    fill="currentColor">
                                    <path
                                        d="M12 2C6.48 2 2 6.58 2 12.26c0 4.5 2.87 8.31 6.84 9.66c.5.09.68-.22.68-.48c0-.24-.01-.87-.01-1.71c-2.78.62-3.37-1.37-3.37-1.37c-.45-1.17-1.1-1.48-1.1-1.48c-.9-.63.07-.62.07-.62c1 .07 1.53 1.05 1.53 1.05c.89 1.56 2.34 1.11 2.91.85c.09-.66.35-1.11.63-1.36c-2.22-.26-4.56-1.14-4.56-5.06c0-1.12.39-2.03 1.03-2.75c-.1-.26-.45-1.3.1-2.71c0 0 .84-.27 2.75 1.05c.8-.23 1.65-.35 2.5-.35c.85 0 1.7.12 2.5.35c1.9-1.32 2.74-1.05 2.74-1.05c.55 1.41.2 2.45.1 2.71c.64.72 1.02 1.63 1.02 2.75c0 3.93-2.34 4.8-4.57 5.05c.36.32.68.95.68 1.92c0 1.39-.01 2.51-.01 2.85c0 .26.18.58.69.48C19.13 20.56 22 16.76 22 12.26C22 6.58 17.52 2 12 2" />
                                </svg>
                            </a>
                        @endif
                        @if (!empty($footerSocials['youtube']))
                            <a href="{{ $footerSocials['youtube'] }}" aria-label="YouTube"
                                class="hover:text-brand-primary transition" target="_blank" rel="noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                    fill="currentColor">
                                    <path
                                        d="M21.6 7.2s-.2-1.4-.8-2c-.7-.8-1.5-.8-1.9-.8C16 4.2 12 4.2 12 4.2h-.1s-4 0-6.8.2c-.4 0-1.2 0-1.9.8c-.6.6-.8 2-.8 2S2 8.8 2 10.3v1.4c0 1.5.2 3.1.2 3.1s.2 1.4.8 2c.7.8 1.6.7 2 .8c1.4.1 6.8.2 6.8.2s4 0 6.8-.2c.4-.1 1.2 0 1.9-.8c.6-.6.8-2 .8-2s.2-1.6.2-3.1v-1.4c0-1.5-.2-3.1-.2-3.1M10 14.7V8.7l5.3 3z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <div class="lg:col-span-2 space-y-6">
                <h4 class="text-xl font-normal text-faux-medium text-[#0a1435] font-heading">Navigasi</h4>
                <ul class="space-y-4 text-[15px] text-[#6b5b59]">
                    @forelse ($footerMenus as $menu)
                        <li>
                            <a class="hover:text-brand-primary transition" href="{{ $menu->getUrl() }}">{{ $menu->title }}</a>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada menu aktif.</li>
                    @endforelse
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <h4 class="text-xl font-normal text-faux-medium text-[#0a1435] font-heading">Kategori Populer</h4>
                <ul class="space-y-0 text-[15px] text-[#6b5b59]">
                    @forelse ($footerCategories as $category)
                        <li class="flex items-center justify-between gap-4 border-b border-[#e2d5cf] py-3 first:pt-0 last:border-0 last:pb-0">
                            <a class="hover:text-brand-primary transition line-clamp-1"
                                href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            <span class="text-[12px] text-[#735A56] font-mono whitespace-nowrap">{{ $category->published_posts_count }} artikel</span>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada kategori.</li>
                    @endforelse
                </ul>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <h4 class="text-xl font-normal text-faux-medium text-[#0a1435] font-heading">Rilisan Terbaru</h4>
                <ul class="space-y-0 text-sm text-gray-700">
                    @forelse ($footerPosts as $post)
                        <li class="flex flex-col gap-2 border-b border-[#e2d5cf] py-4 first:pt-0 last:border-0 last:pb-0">
                            <a class="text-[15px] font-normal text-faux-medium text-[#0a1435] font-heading hover:text-brand-primary transition leading-snug"
                                href="{{ route('posts.show', $post->slug) }}">{{ \Illuminate\Support\Str::limit($post->title, 60) }}</a>
                            <div class="inline-flex items-center gap-1.5 text-[11px] text-[#735A56] font-mono tracking-widest uppercase mt-0.5">
                                <span>{{ $post->category->name ?? 'Umum' }}</span>
                                <span>&middot;</span>
                                <time
                                    datetime="{{ optional($post->published_at ?? $post->created_at)->toDateString() }}">
                                    {{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}
                                </time>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500 py-4 first:pt-0">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="border-t border-[#e2d5cf]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-8 text-sm text-[#735A56] font-mono tracking-wide text-center lg:text-left">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
