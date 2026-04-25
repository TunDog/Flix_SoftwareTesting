<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('Admin dashboard') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Manage accounts, rooms, and reservations.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.users.pending') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Pending users
                </a>
                <a href="{{ route('admin.reservations.pending') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-800">
                    Pending reservations
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-gray-700">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('admin.users.pending') }}" class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Pending users</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $pending_users }}</div>
                    <div class="mt-4 text-sm font-medium text-indigo-600">Review accounts →</div>
                </a>
                <a href="{{ route('admin.reservations.pending') }}" class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Pending reservations</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $pending_reservations }}</div>
                    <div class="mt-4 text-sm font-medium text-indigo-600">Review reservations →</div>
                </a>
                <a href="{{ route('admin.rooms.index') }}" class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Rooms</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $rooms }}</div>
                    <div class="mt-4 text-sm font-medium text-indigo-600">Manage rooms →</div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

