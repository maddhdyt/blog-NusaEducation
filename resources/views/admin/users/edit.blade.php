@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.users.index') }}" class="text-[#0a1435] hover:text-brand-primary font-bold text-sm uppercase tracking-wider transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="block">
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

                <!-- Security Details -->
                <div class="card p-6 space-y-6">
                    <h3 class="text-sm font-bold text-[#0a1435] mb-4 pb-2 border-b border-[#0a1435] uppercase tracking-wider mt-0">Keamanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="password">Password (opsional)</label>
                            <input type="password" name="password" id="password" class="form-input @error('password') border-red-500 @enderror" placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Cocokkan jika mengubah password">
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
