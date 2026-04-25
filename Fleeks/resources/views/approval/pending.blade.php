<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ __('Account pending approval') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">An admin must approve your account before you can reserve rooms.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm">
                <div class="p-6 text-gray-900 space-y-4">
                    <p class="text-sm text-gray-700">
                        Your account is registered, but it must be approved by an admin before you can access the reservation system.
                    </p>
                    <p class="text-sm text-gray-700">
                        Please check back later. You can still update your profile details or log out.
                    </p>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

