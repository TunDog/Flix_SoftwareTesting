<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rooms') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800">
                    Back to admin
                </a>
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-xs font-semibold rounded-md hover:bg-gray-800">
                    New room
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500">
                                <th class="py-2 pr-4">Image</th>
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Capacity</th>
                                <th class="py-2 pr-4">Price/hour</th>
                                <th class="py-2 pr-4">Active</th>
                                <th class="py-2 pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($rooms as $room)
                                <tr>
                                    <td class="py-3 pr-4">
                                        <img
                                            src="{{ $room->image_path ?: '/images/rooms/room-01.svg' }}"
                                            alt="{{ $room->name }}"
                                            class="h-12 w-20 rounded-md object-cover border border-gray-200 bg-gray-50"
                                            loading="lazy"
                                        />
                                    </td>
                                    <td class="py-3 pr-4 font-medium text-gray-900">{{ $room->name }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $room->capacity }}</td>
                                    <td class="py-3 pr-4 text-gray-700">₱{{ number_format((float) $room->price_per_hour, 2) }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $room->is_active ? 'Yes' : 'No' }}</td>
                                    <td class="py-3 pr-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.rooms.edit', $room) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" onsubmit="return confirm('Delete this room?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-gray-700">
                                        No rooms yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

