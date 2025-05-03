<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\SupportEngineerController;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.tickets.index');
        } elseif ($user->role === 'support_engineer') {
            return redirect()->route('support.tickets.index');
        } else {
            return redirect()->route('tickets.index');
        }
    } else {
        return redirect()->route('login');
    }
});

// Breeze Authentication Routes
require __DIR__.'/auth.php';

// Application Routes
Route::middleware('auth')->group(function () {
    // User Routes
    Route::middleware('role:user')->group(function () {
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/comments', [TicketController::class, 'storeComment'])->name('tickets.comments.store');
    });

    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        // Ticket Management Routes
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
        Route::put('/tickets/{ticket}', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
        Route::put('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])->name('admin.tickets.assign');

        // User Management Routes
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Support Engineer Routes
    Route::prefix('support')->middleware('role:support_engineer')->group(function () {
        Route::get('/tickets', [SupportEngineerController::class, 'index'])->name('support.tickets.index');
        Route::get('/tickets/{ticket}', [SupportEngineerController::class, 'show'])->name('support.tickets.show');
        Route::put('/tickets/{ticket}', [SupportEngineerController::class, 'update'])->name('support.tickets.update');
        Route::put('/tickets/{ticket}/claim', [SupportEngineerController::class, 'claim'])->name('support.tickets.claim');
        Route::post('/tickets/{ticket}/comments', [SupportEngineerController::class, 'storeComment'])->name('support.tickets.comments.store');
    });
});
