@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
    </div>

    <div class="card p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Name *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Password (optional)</label>
                <input type="password" name="password"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="Kosongkan jika tidak diubah">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Cocokkan jika mengubah password">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Role *</label>
                <select name="role"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white @error('role') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    required>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}"
                            {{ old('role', $user->roles->first()->name ?? '') == $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
