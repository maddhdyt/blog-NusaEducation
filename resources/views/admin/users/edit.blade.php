@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.users.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="block" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Main Content Area -->
            <div class="xl:col-span-8 space-y-6">
                <!-- User Details -->
                <div class="card p-6 space-y-6">
                    <div>
                        <label class="form-label" for="name">Name *</label>
                        <input type="text" name="name" id="name" class="form-input @error('name') border-red-500 @enderror" placeholder="Masukkan nama user..." value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="email">Email *</label>
                        <input type="email" name="email" id="email" class="form-input @error('email') border-red-500 @enderror" placeholder="Masukkan alamat email..." value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Profil Penulis -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Profil Penulis</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="role_title">Jabatan / Peran (Tampil di Publik)</label>
                            <input type="text" name="role_title" id="role_title" class="form-input" value="{{ old('role_title', $user->role_title) }}" placeholder="Contoh: Kontributor, CEO">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="avatar_url">Avatar URL</label>
                            <input type="url" name="avatar_url" id="avatar_url" class="form-input" value="{{ old('avatar_url', $user->avatar_url) }}" placeholder="https://...">
                        </div>
                        <div>
                            <label class="form-label" for="avatar">Upload Avatar Lokal</label>
                            <input type="file" name="avatar" id="avatar" class="form-input bg-white p-1.5" accept="image/*">
                            @if ($user->avatar_url)
                                <p class="text-xs font-bold text-[#0a1435] mt-2">Saat ini: <a href="{{ $user->avatar_url }}" class="text-blue-600 underline" target="_blank">Lihat Avatar</a></p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="bio">Bio Singkat</label>
                        <textarea name="bio" id="bio" rows="3" class="form-input">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label" for="tiktok_url">TikTok URL</label>
                            <input type="url" name="tiktok_url" id="tiktok_url" class="form-input" value="{{ old('tiktok_url', $user->tiktok_url) }}">
                        </div>
                        <div>
                            <label class="form-label" for="youtube_url">YouTube URL</label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-input" value="{{ old('youtube_url', $user->youtube_url) }}">
                        </div>
                        <div>
                            <label class="form-label" for="newsletter_url">Newsletter URL</label>
                            <input type="url" name="newsletter_url" id="newsletter_url" class="form-input" value="{{ old('newsletter_url', $user->newsletter_url) }}">
                        </div>
                    </div>
                </div>

                <!-- Security Details -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Keamanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="password">Password (opsional)</label>
                            <div x-data="{ show: false }" class="relative">
                                <input :type="show ? 'text' : 'password'" name="password" id="password" autocomplete="new-password" class="form-input pr-10 @error('password') border-red-500 @enderror" placeholder="Kosongkan jika tidak diubah">
                                <button type="button" @click="show = !show" class="absolute top-1/2 -translate-y-1/2 text-[#0a1435]/50 hover:text-[#0a1435] focus:outline-none" style="right: 0.75rem;">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div x-data="{ show: false }" class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="form-input pr-10" placeholder="Cocokkan jika mengubah password">
                                <button type="button" @click="show = !show" class="absolute top-1/2 -translate-y-1/2 text-[#0a1435]/50 hover:text-[#0a1435] focus:outline-none" style="right: 0.75rem;">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Settings Area -->
            <div class="xl:col-span-4">
                <div class="space-y-6 sticky top-6">
                    <!-- Role Card -->
                    <div class="card p-6">
                        <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Role & Akses</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label" for="role">Role *</label>
                                <select name="role" id="role" class="form-input @error('role') border-red-500 @enderror" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ old('role', $user->roles->first()->name ?? '') == $role ? 'selected' : '' }}>
                                            {{ ucfirst($role) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="pt-4 border-t border-[#0a1435] flex gap-3">
                                <button type="submit" class="w-full btn-primary py-3">Update User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
