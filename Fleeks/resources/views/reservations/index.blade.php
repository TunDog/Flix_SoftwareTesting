<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('My reservations') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Track your reservation and approval status.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-800">
                Reserve another room
            </a>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($reservations as $reservation)
                    @php
                        $statusClasses = match ($reservation->status) {
                            'approved' => 'bg-green-50 text-green-800 ring-green-600/20',
                            'rejected' => 'bg-red-50 text-red-800 ring-red-600/20',
                            'cancelled' => 'bg-gray-50 text-gray-800 ring-gray-600/20',
                            default => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
                        };
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="p-5 space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="text-sm text-gray-500">Room</div>
                                    <div class="text-base font-semibold text-gray-900">{{ $reservation->room?->name ?? '—' }}</div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $statusClasses }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 gap-3 text-sm">
                                <div>
                                    <div class="text-gray-500">Movie</div>
                                    <div class="font-medium text-gray-900">{{ $reservation->movie_title ?? '—' }}</div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <div class="text-gray-500">Start</div>
                                        <div class="font-medium text-gray-900">{{ $reservation->starts_at?->format('Y-m-d H:i') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-gray-500">End</div>
                                        <div class="font-medium text-gray-900">{{ $reservation->ends_at?->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-gray-500">Payment</div>
                                        <div class="font-medium text-gray-900">{{ str_replace('_', ' ', $reservation->payment_method) }}</div>
                                    </div>
                                </div>
                                @if ($reservation->admin_note)
                                    <div class="rounded-lg bg-gray-50 border border-gray-100 p-3">
                                        <div class="text-gray-500 text-xs font-medium">Admin note</div>
                                        <div class="text-gray-800 text-sm mt-1">{{ $reservation->admin_note }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl border border-gray-100 shadow-sm">
                        <div class="p-6 text-gray-700">
                            No reservations yet.
                        </div>
                    </div>
                @endforelse
            </div>

            <div>
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

