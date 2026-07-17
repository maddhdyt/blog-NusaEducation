@extends('layouts.admin')

@section('page_title', 'Post Management')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-heading font-bold text-[#0a1435] tracking-tight">Semua Postingan</h2>
        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-[#0a1435] border border-[#0a1435] text-white text-sm font-bold uppercase tracking-wider hover:bg-[#FDF6F0] hover:text-[#0a1435] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Post
        </a>
    </div>

    <div class="card bg-white mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FDF6F0]">
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Title</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Category</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Author</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Date</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435]">Views</th>
                        <th class="py-4 px-6 text-xs font-bold text-[#0a1435] uppercase tracking-wider border-b border-[#0a1435] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#0a1435]/10">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-[#FDF6F0] transition-colors group">
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-[#0a1435] font-bold hover:underline">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-white text-[#0a1435] text-xs font-bold uppercase">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435]">{{ $post->user->name }}</td>
                            <td class="py-4 px-6">
                                @if ($post->status === 'published')
                                    <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#b4f3b4] text-[#0a1435] text-xs font-bold uppercase">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 border border-[#0a1435] bg-[#ffccb0] text-[#0a1435] text-xs font-bold uppercase">Draft</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435]">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-sm font-semibold text-[#0a1435]">{{ number_format($post->views) }}</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($post->status === 'published')
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 border border-[#0a1435] bg-white text-[#0a1435] hover:bg-[#FDF6F0] transition-colors text-xs font-bold uppercase tracking-wider">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            VIEW
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-[#0a1435] bg-white text-[#0a1435] hover:bg-[#b5dbff] transition-colors text-xs font-bold uppercase tracking-wider">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        EDIT
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-[#0a1435] bg-white text-red-600 hover:bg-[#ffccb0] hover:text-red-700 transition-colors text-xs font-bold uppercase tracking-wider">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-[#0a1435] font-semibold">No posts yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div class="p-6 border-t border-[#0a1435]">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
