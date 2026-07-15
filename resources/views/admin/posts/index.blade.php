@extends('layouts.admin')

@section('page_title', 'Posts')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold">All Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary">Create New Post</a>
    </div>

    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left py-3 px-4">Title</th>
                        <th class="text-left py-3 px-4">Category</th>
                        <th class="text-left py-3 px-4">Author</th>
                        <th class="text-left py-3 px-4">Status</th>
                        <th class="text-left py-3 px-4">Date</th>
                        <th class="text-right py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="py-3 px-4">{{ $post->category->name }}</td>
                            <td class="py-3 px-4">{{ $post->user->name }}</td>
                            <td class="py-3 px-4">
                                @if ($post->status === 'published')
                                    <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-sm">Published</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded text-sm">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4 text-right">
                                <div class="flex gap-2 justify-end">
                                    @if ($post->status === 'published')
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800">
                                            View
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">No posts yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
