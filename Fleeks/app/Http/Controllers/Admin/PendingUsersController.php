<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PendingUsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->where('account_status', 'pending')
            ->latest()
            ->paginate(20);

        return view('admin.users.pending', [
            'users' => $users,
        ]);
    }

    public function approve(Request $request, User $user)
    {
        $user->forceFill([
            'account_status' => 'approved',
        ])->save();

        return back()->with('status', 'User approved.');
    }

    public function reject(Request $request, User $user)
    {
        $user->forceFill([
            'account_status' => 'rejected',
        ])->save();

        return back()->with('status', 'User rejected.');
    }
}

