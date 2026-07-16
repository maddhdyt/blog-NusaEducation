@extends('layouts.admin')

@section('page_title', 'Users Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Pengguna Sistem</h2>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-[#0a1435] border border-[#0a1435] text-white text-sm font-bold uppercase tracking-wider hover:bg-[#FDF6F0] hover:text-[#0a1435] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="bg-[#b4f3b4] border border-[#0a1435] text-[#0a1435] font-bold px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FDF6F0]">
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Nama</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Email</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Role</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#0a1435]/10">
                    @forelse ($users as $user)
                        <tr class="hover:bg-[#FDF6F0] transition-colors group">
                            <td class="py-4 px-6 text-sm font-bold text-[#0a1435]">{{ $user->name }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435]">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435]">
                                <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#b5dbff] text-[#0a1435] text-xs font-bold uppercase">
                                    {{ $user->roles->pluck('name')->join(', ') ?: '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-[#0a1435] bg-white text-[#0a1435] hover:bg-[#b5dbff] transition-colors text-xs font-bold uppercase tracking-wider">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Hapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-[#0a1435] bg-white text-red-600 hover:bg-[#ffccb0] hover:text-red-700 transition-colors text-xs font-bold uppercase tracking-wider">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                DELETE
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-[#0a1435] font-semibold">Belum ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-6 border-t border-[#0a1435]">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
