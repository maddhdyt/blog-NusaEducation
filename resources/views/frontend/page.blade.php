@extends('layouts.frontend')

@section('content')
    <style>
        .quill-content {
            color: #433836;
            font-size: 1.125rem;
            line-height: 1.8;
        }
        /* Refined Drop Cap for the first paragraph */
        .quill-content > p:first-of-type::first-letter {
            float: left;
            font-size: 5rem;
            line-height: 0.8;
            padding-top: 0.15rem;
            padding-right: 0.5rem;
            margin-bottom: -0.2rem;
            font-family: 'Feature', serif;
            color: #0a1435;
        }
        .quill-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0;
            margin: 2rem 0;
            border: 1px solid #e2d5cf;
        }
        .quill-content iframe {
            width: 100%;
            min-height: 400px;
            margin: 2rem 0;
        }
        .quill-content a {
            color: #0a1435;
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 600;
        }
        .quill-content a:hover {
            color: #1786F8;
        }
        .quill-content h2, .quill-content h3, .quill-content h4 {
            color: #0a1435;
            font-family: 'Feature', serif;
            font-weight: 500;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
        }
        .quill-content h2 { font-size: 2.25rem; }
        .quill-content h3 { font-size: 1.75rem; }
        .quill-content ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content ol {
            list-style: decimal;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
        }
        .quill-content blockquote {
            border-left: 4px solid #0a1435;
            padding-left: 1.5rem;
            margin: 2rem 0;
            color: #6b5b59;
            font-style: italic;
            font-size: 1.25rem;
            background: rgba(226, 213, 207, 0.2);
            padding: 1.5rem;
        }
    </style>

    <div class="bg-[#FDF6F0] py-10 lg:py-16 min-h-[70vh]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
                
                {{-- Editorial Left Sidebar (Decorative/Meta) --}}
                <div class="lg:col-span-3 hidden lg:flex flex-col items-end text-right">
                    <div class="sticky top-24 w-full space-y-10 border-r border-[#e2d5cf] pr-8">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#0a1435] font-mono mb-2">Halaman Informasi</p>
                            <h2 class="text-4xl font-heading text-[#0a1435] leading-tight">Nusa<br>Education</h2>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#0a1435] font-mono mb-2">Pembaruan Terakhir</p>
                            <p class="text-[13px] text-[#735A56] font-mono">{{ optional($page->updated_at)->translatedFormat('d M Y') ?? date('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#0a1435] font-mono mb-2">Hak Cipta</p>
                            <p class="text-[13px] text-[#735A56] font-mono">&copy; {{ date('Y') }} Dilindungi</p>
                        </div>
                    </div>
                </div>

                {{-- Main Content Right Side --}}
                <div class="lg:col-span-7 space-y-12">
                    <div class="border-b border-[#0a1435] pb-8">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-brand-primary font-mono mb-6 block lg:hidden">Halaman Informasi</p>
                        <h1 class="text-6xl sm:text-7xl lg:text-[6rem] font-normal text-faux-medium text-[#0a1435] font-heading leading-tight">{{ $page->title }}</h1>
                    </div>

                    <div class="quill-content max-w-none">
                        {!! $page->content !!}
                    </div>
                </div>
                
                {{-- Spacer --}}
                <div class="lg:col-span-2 hidden lg:block"></div>
            </div>

        </div>
    </div>
@endsection
