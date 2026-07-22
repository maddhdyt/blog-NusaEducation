<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->orderBy('name')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = ['admin', 'user'];
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', 'in:admin,user'],
            'role_title' => ['nullable', 'string', 'max:255'],
            'avatar_url' => ['nullable', 'url'],
            'avatar' => ['nullable', 'file', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'tiktok_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'newsletter_url' => ['nullable', 'url'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('storage/users/avatars');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $user->avatar_url = asset('storage/users/avatars/' . $filename);
        } else if (!empty($data['avatar_url'])) {
            $user->avatar_url = $data['avatar_url'];
        }

        $user->role_title = $data['role_title'] ?? null;
        $user->bio = $data['bio'] ?? null;
        $user->tiktok_url = $data['tiktok_url'] ?? null;
        $user->youtube_url = $data['youtube_url'] ?? null;
        $user->newsletter_url = $data['newsletter_url'] ?? null;
        $user->save();

        $role = Role::firstOrCreate(['name' => $data['role']]);
        $user->syncRoles([$role]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        $roles = ['admin', 'user'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'role' => ['required', 'in:admin,user'],
            'role_title' => ['nullable', 'string', 'max:255'],
            'avatar_url' => ['nullable', 'url'],
            'avatar' => ['nullable', 'file', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'tiktok_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'newsletter_url' => ['nullable', 'url'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('storage/users/avatars');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $user->avatar_url = asset('storage/users/avatars/' . $filename);
        } else if (array_key_exists('avatar_url', $data)) {
            $user->avatar_url = $data['avatar_url'];
        }

        $user->role_title = $data['role_title'] ?? null;
        $user->bio = $data['bio'] ?? null;
        $user->tiktok_url = $data['tiktok_url'] ?? null;
        $user->youtube_url = $data['youtube_url'] ?? null;
        $user->newsletter_url = $data['newsletter_url'] ?? null;

        $user->save();

        $role = Role::firstOrCreate(['name' => $data['role']]);
        $user->syncRoles([$role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
