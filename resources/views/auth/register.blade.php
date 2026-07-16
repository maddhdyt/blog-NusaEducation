<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="inline-block mb-4">
            <img src="https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto" alt="Nusa Education" class="h-16 w-auto -ml-3">
        </a>

        <!-- Title -->
        <h2 class="text-3xl font-heading text-[#0a1435] tracking-tight mb-8">Daftar Akun Baru</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full h-11 flex items-center justify-center bg-[#1786F8] text-white text-sm font-bold hover:bg-blue-600 transition-colors rounded-md shadow-sm">
                    Buat Akun
                </button>
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 space-y-4">
                <p>
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-brand-primary hover:underline">Log in di sini.</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
