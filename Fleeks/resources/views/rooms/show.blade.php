<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                {{ $room->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Reserve this room for the movie you want to watch.</p>
            </div>
            <a href="{{ route('rooms.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800">
                Back to rooms
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm">
                <div class="aspect-[16/9] bg-gray-50 border-b border-gray-100 overflow-hidden">
                    <img
                        src="{{ $room->image_path ?: '/images/rooms/room-01.svg' }}"
                        alt="{{ $room->name }}"
                        class="w-full h-full object-cover"
                        loading="lazy"
                    />
                </div>
                <div class="p-6 space-y-4">
                    @if ($room->description)
                        <p class="text-sm text-gray-700">{{ $room->description }}</p>
                    @endif

                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                            Capacity: {{ $room->capacity }} pax
                        </span>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gray-100 text-gray-700 text-xs font-medium">
                            ₱{{ number_format((float) $room->price_per_hour, 2) }} / hour
                        </span>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium">
                            Private screening
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900">Request a reservation</h3>
                    <p class="mt-1 text-sm text-gray-600">Enter the movie title and your preferred schedule.</p>

                    <form method="POST" action="{{ route('rooms.reservations.store', $room) }}" enctype="multipart/form-data" class="mt-4 space-y-4">
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

                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Submit request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

