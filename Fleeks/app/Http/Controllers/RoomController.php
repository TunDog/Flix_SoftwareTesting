<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::query()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    public function show(Room $room)
    {
        abort_unless($room->is_active, 404);

        return view('rooms.show', [
            'room' => $room,
        ]);
    }
}

