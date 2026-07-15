<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email'],
        ]);

        $data['subscribed_at'] = now();

        Subscriber::create($data);

        return back()->with('subscribe_success', 'Terima kasih! Kamu akan menerima notifikasi setiap ada artikel baru.');
    }
}
