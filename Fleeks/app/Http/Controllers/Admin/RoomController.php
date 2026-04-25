<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::query()->latest()->paginate(20);

        return view('admin.rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        if ($request->hasFile('image')) {
            $data['image_path'] = '/storage/'.$request->file('image')->store('room_images', 'public');
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('status', 'Room created.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', [
            'room' => $room,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        if (($data['remove_image'] ?? false) === true) {
            if ($room->image_path && str_starts_with($room->image_path, '/storage/')) {
                $relative = ltrim(substr($room->image_path, strlen('/storage/')), '/');
                Storage::disk('public')->delete($relative);
            }
            $data['image_path'] = null;
        }

        if ($request->hasFile('image')) {
            if ($room->image_path && str_starts_with($room->image_path, '/storage/')) {
                $relative = ltrim(substr($room->image_path, strlen('/storage/')), '/');
                Storage::disk('public')->delete($relative);
            }

            $data['image_path'] = '/storage/'.$request->file('image')->store('room_images', 'public');
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('status', 'Room updated.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return back()->with('status', 'Room deleted.');
    }
}

