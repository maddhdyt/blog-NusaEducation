@extends('layouts.admin')

@section('title', 'Subscribers')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Subscribers</h1>
        <p class="text-sm text-gray-500">Daftar email langganan newsletter.</p>
    </div>

    <div class="card p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nama
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Email
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Subscribed</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($subscribers as $subscriber)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $subscriber->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $subscriber->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ optional($subscriber->subscribed_at)->diffForHumans() ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-right">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                    onsubmit="return confirm('Hapus subscriber ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-700 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada subscriber.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $subscribers->links() }}</div>
    </div>
@endsection
