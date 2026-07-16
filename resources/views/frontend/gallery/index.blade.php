@extends('layouts.frontend')

@section('content')
    <div class="bg-[#FDF6F0] py-16 lg:py-24 min-h-[70vh]">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            
            <div class="flex flex-col gap-12 lg:gap-16">
                {{-- Header Section --}}
                <div class="border-b-2 border-[#e2d5cf] pb-10">
                    <p class="text-[11px] font-bold uppercase tracking-widest text-brand-primary font-mono mb-4">Galeri</p>
                    <h1 class="text-5xl sm:text-6xl lg:text-[5rem] font-normal text-faux-medium text-[#0a1435] font-heading leading-tight">Koleksi Foto</h1>
                    <p class="text-xl text-[#6b5b59] mt-6 max-w-2xl">Klik foto untuk melihat tampilan besar beserta keterangan.</p>
                </div>

                @if ($items->isEmpty())
                    <div class="py-20 lg:py-32 text-center">
                        <h2 class="text-3xl font-heading text-[#0a1435]">Belum ada foto.</h2>
                        <p class="text-[#6b5b59] font-mono tracking-widest text-[11px] mt-4 uppercase">Silakan kembali lagi nanti.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8" id="gallery-grid">
                        @foreach ($items as $item)
                            <button type="button" data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                                data-image="{{ $item->image_url }}"
                                class="group relative h-96 overflow-hidden bg-[#0a1435] border border-[#e2d5cf] flex items-center justify-center text-left">
                                
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                        class="absolute inset-0 h-full w-full object-cover transition duration-1000 group-hover:scale-105 group-hover:opacity-60 opacity-90"
                                        loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0a1435]/20 to-[#0a1435]/95 transition-opacity duration-500"></div>
                                @else
                                    <div class="absolute inset-0 h-full w-full bg-[#0a1435] transition duration-1000 group-hover:scale-105 group-hover:opacity-60 opacity-90 flex items-center justify-center">
                                        <span class="text-[6rem] font-bold text-[#FDF6F0] font-heading opacity-10">{{ Str::upper(Str::substr($item->title, 0, 1)) }}</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#0a1435]/95 transition-opacity duration-500"></div>
                                @endif

                                <div class="relative flex h-full flex-col justify-end p-6 space-y-3 text-[#FDF6F0] w-full z-10 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    <div class="flex items-center gap-3 text-[10px] font-mono tracking-[0.2em] uppercase text-[#e2d5cf]">
                                        <span>{{ optional($item->created_at)->translatedFormat('d M Y') }}</span>
                                        <span>&middot;</span>
                                        <span>Galeri</span>
                                    </div>
                                    <h3 class="text-2xl font-normal text-faux-medium font-heading leading-tight">{{ $item->title }}</h3>
                                    @if ($item->description)
                                        <p class="text-sm text-[#e2d5cf] line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-700 delay-100">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Gallery Modal --}}
    <div id="gallery-modal" class="fixed inset-0 bg-[#0a1435]/95 backdrop-blur-md hidden items-center justify-center z-[100] px-4 lg:px-12 py-12">
        <div class="w-full h-full max-w-7xl mx-auto flex flex-col relative border border-[#e2d5cf]/20 bg-transparent">
            {{-- Modal Header --}}
            <div class="flex items-start justify-between p-6 lg:p-8 border-b border-[#e2d5cf]/20 bg-[#0a1435] z-10">
                <div class="space-y-3 max-w-3xl">
                    <h3 id="gallery-modal-title" class="text-3xl lg:text-4xl font-heading text-[#FDF6F0] leading-tight"></h3>
                    <p id="gallery-modal-desc" class="text-[#e2d5cf] font-mono text-sm leading-relaxed"></p>
                </div>
                <button type="button" id="gallery-modal-close" class="text-[#e2d5cf] hover:text-[#FDF6F0] transition flex items-center justify-center h-12 w-12 border border-[#e2d5cf]/30 hover:bg-[#e2d5cf]/10">
                    <span class="text-3xl leading-none">&times;</span>
                </button>
            </div>
            {{-- Modal Image Container --}}
            <div class="flex-1 overflow-hidden bg-black/50 p-4 lg:p-12 flex items-center justify-center relative">
                <img id="gallery-modal-image" src="" alt="" class="max-w-full max-h-full object-contain border border-[#e2d5cf]/20 shadow-2xl">
                <div id="gallery-modal-placeholder" class="hidden text-[#e2d5cf] font-mono tracking-widest uppercase text-sm border border-[#e2d5cf]/20 px-8 py-4 bg-[#0a1435]">
                    No Image Available
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('gallery-modal');
            const titleEl = document.getElementById('gallery-modal-title');
            const descEl = document.getElementById('gallery-modal-desc');
            const imgEl = document.getElementById('gallery-modal-image');
            const placeholderEl = document.getElementById('gallery-modal-placeholder');
            const closeBtn = document.getElementById('gallery-modal-close');
            // Ensure body scroll is locked when modal is open
            const body = document.body;

            const openModal = (title, desc, src) => {
                titleEl.textContent = title || '';
                descEl.textContent = desc || '';
                
                if (src) {
                    imgEl.src = src;
                    imgEl.classList.remove('hidden');
                    placeholderEl.classList.add('hidden');
                } else {
                    imgEl.src = '';
                    imgEl.classList.add('hidden');
                    placeholderEl.classList.remove('hidden');
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                body.style.overflow = 'hidden';
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                imgEl.src = '';
                body.style.overflow = '';
            };

            document.querySelectorAll('#gallery-grid button').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal(btn.dataset.title, btn.dataset.description, btn.dataset.image);
                });
            });

            closeBtn?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal || e.target.closest('.flex-1') === e.target) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });
        });
    </script>
@endpush
