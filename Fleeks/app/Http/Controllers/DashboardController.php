<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $rooms = Room::query()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('dashboard', [
            'rooms' => $rooms,
        ]);
    }
}

