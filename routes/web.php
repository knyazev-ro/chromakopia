<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;

Route::get('/test', function(){
    return view('pdf.meeting');
});

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('calendar')->controller(CalendarController::class)->group(function(){
        Route::get('/index', 'index')->name('calendar.index');
        Route::post('/calendar/{meeting}', 'calendarDnD')->name('calendar.dnd');
    });


    Route::resource('users', UserController::class);

});


Route::get('/init', [EntryController::class, 'show'])->name('init');

require __DIR__.'/auth.php';
require __DIR__.'/mobile-web.php';
