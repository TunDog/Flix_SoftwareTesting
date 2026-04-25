<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create room') }}
            </h2>
            <a href="{{ route('admin.rooms.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800">
                Back to rooms
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.rooms.store') }}" class="space-y-4" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="capacity" value="Capacity" />
                                <x-text-input id="capacity" name="capacity" type="number" min="1" class="mt-1 block w-full" :value="old('capacity', 1)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('capacity')" />
                            </div>
                            <div>
                                <x-input-label for="price_per_hour" value="Price per hour" />
                                <x-text-input id="price_per_hour" name="price_per_hour" type="number" min="0" step="0.01" class="mt-1 block w-full" :value="old('price_per_hour', 0)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price_per_hour')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="image" value="Room image (optional)" />
                            <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                            <p class="mt-1 text-xs text-gray-500">Tip: you can also just replace the placeholder images in <code class="font-mono">public/images/rooms</code>.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="flex items-center gap-2">
                            <input id="is_active" name="is_active" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="text-sm text-gray-700">Active</label>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

