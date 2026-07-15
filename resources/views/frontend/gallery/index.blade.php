@extends('layouts.frontend')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">Galeri</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Koleksi Foto</h1>
                    <p class="text-gray-600 mt-2">Klik foto untuk melihat tampilan besar beserta keterangan.</p>
                </div>
            </div>

            @if ($items->isEmpty())
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-8 text-gray-600">Belum ada foto.</div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="gallery-grid">
                    @foreach ($items as $item)
                        <button type="button" data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                            data-image="{{ $item->image_url }}"
                            class="group relative h-80 overflow-hidden rounded-3xl bg-black shadow-lg ring-1 ring-black/10">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-b from-black/15 via-black/35 to-black/85"></div>
                            <div class="relative flex h-full flex-col justify-end p-5 space-y-2 text-white">
                                <div class="flex items-center gap-3 text-xs text-white/80">
                                    <span>{{ optional($item->created_at)->translatedFormat('M d, Y') }}</span>
                                    <span class="h-1 w-1 rounded-full bg-white/70"></span>
                                    <span>Galeri</span>
                                </div>
                                <h3 class="text-lg font-semibold leading-tight drop-shadow">{{ $item->title }}</h3>
                                @if ($item->description)
                                    <p class="text-sm text-white/90 line-clamp-2">{{ $item->description }}</p>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div id="gallery-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden">
            <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b border-gray-200">
                <div class="space-y-1">
                    <h3 id="gallery-modal-title" class="text-lg font-semibold text-gray-900"></h3>
                    <p id="gallery-modal-desc" class="text-sm text-gray-600"></p>
                </div>
                <button type="button" id="gallery-modal-close" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="bg-black">
                <img id="gallery-modal-image" src="" alt="" class="w-full h-[70vh] object-contain bg-black">
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
            const closeBtn = document.getElementById('gallery-modal-close');

            const openModal = (title, desc, src) => {
                titleEl.textContent = title || '';
                descEl.textContent = desc || '';
                imgEl.src = src;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            const closeModal = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                imgEl.src = '';
            };

            document.querySelectorAll('#gallery-grid button').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal(btn.dataset.title, btn.dataset.description, btn.dataset.image);
                });
            });

            closeBtn?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });
        });
    </script>
@endpush
