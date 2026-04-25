<x-guest-layout>

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            <!-- Logo / Title -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Welcome Back</h1>
                <p class="text-sm text-gray-500">Login to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 relative">
                    <x-input-label for="password" :value="__('Password')" />

                    <input id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 pr-10"
                        type="password"
                        name="password"
                        required />

                    <!-- Toggle Password -->
                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        👁
                    </button>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between mt-4 text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-indigo-600 hover:underline">
                            Forgot?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200 shadow-md">
                        Log in
                    </button>
                </div>

                <!-- Register -->
                @if (Route::has('register'))
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
                            Create one
                        </a>
                    </p>
                @endif

            </form>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>