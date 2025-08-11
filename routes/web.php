<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('', function(){
    return redirect()->route('tickets.index');
});

Route::resource('tickets', TicketController::class);

// Route::get('/', [TicketController::class, 'index']);

// Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
// Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
// Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
// Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
// Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
// Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
// Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');