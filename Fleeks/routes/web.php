<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PendingReservationsController;
use App\Http\Controllers\Admin\PendingUsersController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    if (($user->role ?? 'user') === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (($user->account_status ?? 'pending') !== 'approved') {
        return redirect()->route('approval.pending');
    }

    return redirect()->route('dashboard');
});

Route::get('/approval/pending', function () {
    return view('approval.pending');
})->middleware('auth')->name('approval.pending');

Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    Route::post('/rooms/{room}/reservations', [ReservationController::class, 'store'])->name('rooms.reservations.store');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    Route::get('/users/pending', [PendingUsersController::class, 'index'])->name('users.pending');
    Route::post('/users/{user}/approve', [PendingUsersController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [PendingUsersController::class, 'reject'])->name('users.reject');

    Route::resource('/rooms', AdminRoomController::class)->except(['show']);

    Route::get('/reservations/pending', [PendingReservationsController::class, 'index'])->name('reservations.pending');
    Route::post('/reservations/{reservation}/approve', [PendingReservationsController::class, 'approve'])->name('reservations.approve');
    Route::post('/reservations/{reservation}/reject', [PendingReservationsController::class, 'reject'])->name('reservations.reject');
});

require __DIR__.'/auth.php';
