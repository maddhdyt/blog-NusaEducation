<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Baru</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f6f7fb;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #111827;
        }

        .wrapper {
            width: 100%;
            padding: 32px 0;
        }

        .card {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.10);
            border: 1px solid #e5e7eb;
        }

        .header {
            padding: 22px 28px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #ffffff;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .title {
            margin: 10px 0 6px;
            font-size: 24px;
            font-weight: 800;
            line-height: 1.3;
        }

        .subtitle {
            margin: 0;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.82);
        }

        .hero {
            position: relative;
            padding: 0;
            overflow: hidden;
        }

        .hero img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block;
        }

        .content {
            padding: 26px 28px 10px;
            line-height: 1.6;
        }

        .meta {
            display: flex;
            gap: 12px;
            font-size: 13px;
            color: #6b7280;
            margin: 0 0 14px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 12px;
            font-weight: 700;
        }

        .excerpt {
            margin: 0 0 18px;
            color: #374151;
            font-size: 15px;
        }

        .cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border-radius: 12px;
            background: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(79, 70, 229, 0.35);
        }

        .footer {
            padding: 22px 28px 26px;
            color: #6b7280;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .footer a {
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 520px) {
            .card {
                border-radius: 14px;
            }

            .header,
            .content,
            .footer {
                padding: 20px 18px;
            }

            .hero img {
                height: 220px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <span class="badge">Artikel Baru</span>
                <h1 class="title">{{ $post->title }}</h1>
                <p class="subtitle">{{ optional($post->published_at)->translatedFormat('d M Y') }} ·
                    {{ $post->category->name ?? 'Umum' }}</p>
            </div>

            @if ($post->thumbnail_url)
                <div class="hero">
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="content">
                <div class="meta">
                    <span class="pill">{{ $post->category->name ?? 'Umum' }}</span>
                    <span>{{ optional($post->user)->name ?? 'Redaksi ArkaSEO' }}</span>
                </div>
                <p class="excerpt">
                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 180) }}</p>
                <a class="cta" href="{{ route('posts.show', $post->slug) }}" target="_blank" rel="noopener">
                    Baca selengkapnya
                    <span style="font-size:14px;">&#10140;</span>
                </a>
            </div>

            <div class="footer">
                <p style="margin:0 0 6px;">Kamu menerima email ini karena telah berlangganan di ArkaSEO.</p>
                <p style="margin:0;">Jika tautan tidak berfungsi, salin URL berikut:
                    {{ route('posts.show', $post->slug) }}</p>
            </div>
        </div>
    </div>
</body>

</html>
