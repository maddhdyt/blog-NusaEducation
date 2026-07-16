<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="inline-block mb-4">
            <img src="https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto" alt="Nusa Education" class="h-16 w-auto -ml-3">
        </a>

        <!-- Title -->
        <h2 class="text-3xl font-heading text-[#0a1435] tracking-tight mb-8">Log in ke Blog Nusa Education</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full h-11 bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-primary focus:border-transparent rounded-md shadow-sm transition-colors">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-brand-primary shadow-sm focus:ring-brand-primary w-4 h-4 cursor-pointer" name="remember">
                    <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-brand-primary hover:text-blue-700 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full h-11 flex items-center justify-center bg-[#1786F8] text-white text-sm font-bold hover:bg-blue-600 transition-colors rounded-md shadow-sm">
                    Log in
                </button>
            </div>
            
            <div class="mt-8 text-sm text-gray-500 space-y-4">
                <p>
                    Dengan melanjutkan, Anda menyetujui <a href="#" class="text-brand-primary hover:underline">Syarat Layanan</a> dan <a href="#" class="text-brand-primary hover:underline">Kebijakan Privasi</a> kami.
                </p>
                <p>
                    Belum punya akun? <span class="text-gray-900 font-medium">Hubungi administrator.</span>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
