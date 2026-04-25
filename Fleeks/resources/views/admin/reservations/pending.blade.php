<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('Pending reservations') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Approve or reject requests. Approvals re-check schedule conflicts.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Back
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

            <div class="bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="py-2 pr-4">User</th>
                                <th class="py-2 pr-4">Room</th>
                                <th class="py-2 pr-4">Movie</th>
                                <th class="py-2 pr-4">Schedule</th>
                                <th class="py-2 pr-4">Payment</th>
                                <th class="py-2 pr-4">Proof</th>
                                <th class="py-2 pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($reservations as $reservation)
                                <tr>
                                    <td class="py-3 pr-4 font-medium text-gray-900">
                                        <div>{{ $reservation->user?->name ?? '—' }}</div>
                                        <div class="text-xs text-gray-500">{{ $reservation->user?->email ?? '' }}</div>
                                    </td>
                                    <td class="py-3 pr-4 text-gray-700">
                                        {{ $reservation->room?->name ?? '—' }}
                                    </td>
                                    <td class="py-3 pr-4 text-gray-700">
                                        {{ $reservation->movie_title ?? '—' }}
                                    </td>
                                    <td class="py-3 pr-4 text-gray-700">
                                        {{ $reservation->starts_at?->format('Y-m-d H:i') }} → {{ $reservation->ends_at?->format('Y-m-d H:i') }}
                                    </td>
                                    <td class="py-3 pr-4 text-gray-700">
                                        {{ str_replace('_', ' ', $reservation->payment_method) }}
                                    </td>
                                    <td class="py-3 pr-4 text-gray-700">
                                        @if ($reservation->payment_proof_path)
                                            <a
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-700"
                                                href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($reservation->payment_proof_path) }}"
                                                target="_blank"
                                                rel="noreferrer"
                                            >
                                                View
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="py-3 pr-4">
                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('admin.reservations.approve', $reservation) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-xs font-semibold rounded-md hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.reservations.reject', $reservation) }}" class="flex items-center gap-2">
                                                @csrf
                                                <input
                                                    type="text"
                                                    name="admin_note"
                                                    class="w-56 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                                    placeholder="Optional note"
                                                />
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-semibold rounded-md hover:bg-gray-50">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-6 text-gray-700">
                                        No pending reservations.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

