<x-guest-layout>

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Create Account</h1>
                <p class="text-sm text-gray-500">Register to get started</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required />
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

                    <!-- Toggle -->
                    <button type="button"
                        onclick="togglePassword('password')"
                        class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        👁
                    </button>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 relative">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <input id="password_confirmation"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 pr-10"
                        type="password"
                        name="password_confirmation"
                        required />

                    <!-- Toggle -->
                    <button type="button"
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                        👁
                    </button>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200 shadow-md">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                        Login here
                    </a>
                </p>

            </form>
        </div>
    </div>

    <!-- Toggle Script -->
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>