<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('Choose a room') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Pick a room, select schedule, and reserve for the movie you want to watch.
                </p>
            </div>
            <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                My reservations
            </a>
        </div>
    </x-slot>

    <div
        class="py-12"
        x-data="{
            open: false,
            room: null,
            openFor(room) { this.room = room; this.open = true; },
            close() { this.open = false; this.room = null; },
            action() { return this.room ? `/rooms/${this.room.id}/reservations` : '#'; },
        }"
        @keydown.escape.window="close()"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-gray-700">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($rooms as $room)
                    <div class="bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="aspect-[16/9] bg-gray-50 border-b border-gray-100 overflow-hidden">
                            <img
                                src="{{ $room->image_path ?: '/images/rooms/room-01.svg' }}"
                                alt="{{ $room->name }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            />
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="space-y-1">
                                <div class="flex items-start justify-between gap-3">
                                    <h3 class="text-lg font-semibold text-gray-900 leading-snug">
                                        {{ $room->name }}
                                    </h3>
                                    <span class="shrink-0 text-xs font-medium px-2 py-1 rounded-full bg-gray-100 text-gray-700">
                                        {{ $room->capacity }} pax
                                    </span>
                                </div>
                                @if ($room->description)
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $room->description }}
                                    </p>
                                @endif
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    <span class="font-semibold text-gray-900">₱{{ number_format((float) $room->price_per_hour, 2) }}</span>
                                    <span class="text-gray-500">/ hour</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('rooms.show', $room) }}" class="inline-flex items-center px-3 py-2 rounded-md text-xs font-semibold border border-gray-200 text-gray-700 hover:bg-gray-50">
                                        Details
                                    </a>
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 bg-gray-900 text-white text-xs font-semibold rounded-md hover:bg-gray-800"
                                        @click="openFor({ id: {{ $room->id }}, name: @js($room->name) })"
                                    >
                                        Reserve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-700">
                            No rooms available yet.
                        </div>
                    </div>
                @endforelse
            </div>

            <div>
                {{ $rooms->links() }}
            </div>
        </div>

        <!-- Reserve Modal -->
        <div
            class="fixed inset-0 z-50 flex items-center justify-center px-4"
            x-show="open"
            x-transition.opacity
            style="display: none;"
            aria-modal="true"
            role="dialog"
        >
            <div class="absolute inset-0 bg-gray-900/50" @click="close()"></div>

            <div class="relative w-full max-w-lg bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="space-y-0.5">
                        <h3 class="text-base font-semibold text-gray-900">Reserve room</h3>
                        <p class="text-sm text-gray-600" x-text="room?.name"></p>
                    </div>
                    <button type="button" class="text-gray-500 hover:text-gray-700" @click="close()">
                        <span class="sr-only">Close</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 11-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <form method="POST" enctype="multipart/form-data" :action="action()" class="p-6 space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="movie_title" value="Movie title" />
                        <x-text-input id="movie_title" name="movie_title" type="text" class="mt-1 block w-full" :value="old('movie_title')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('movie_title')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="starts_at" value="Start date & time" />
                            <x-text-input id="starts_at" name="starts_at" type="datetime-local" class="mt-1 block w-full" :value="old('starts_at')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('starts_at')" />
                        </div>
                        <div>
                            <x-input-label for="ends_at" value="End date & time" />
                            <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="mt-1 block w-full" :value="old('ends_at')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('ends_at')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="payment_method" value="Payment method" />
                        <select id="payment_method" name="payment_method" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>Select...</option>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="gcash" {{ old('payment_method') === 'gcash' ? 'selected' : '' }}>GCash</option>
                            <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Bank transfer</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('payment_method')" />
                    </div>

                    <div>
                        <x-input-label for="payment_proof" value="Payment proof (optional / required for GCash & bank transfer)" />
                        <input id="payment_proof" name="payment_proof" type="file" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                        <x-input-error class="mt-2" :messages="$errors->get('payment_proof')" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50" @click="close()">
                            Cancel
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                            Submit request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
