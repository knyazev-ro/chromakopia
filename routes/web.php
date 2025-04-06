<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\MeetingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\PDFnotification1F;
use App\Http\Controllers\PDFprojectResolve;
use App\Http\Controllers\PDFsupportSheet;

Route::get('/notification-pdf', [PDFnotification1F::class, 'generateNotice']);
Route::get('/project-resolve-pdf', [PDFprojectResolve::class, 'generateNotice']);
Route::get('/support-sheet-pdf', [PDFsupportSheet::class, 'generateNotice']);

Route::get('/test', function(){
    return view('pdf.notification');
});

Route::get('/', function () {
    return Redirect::to(route('calendar.index'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('calendar')->controller(CalendarController::class)->group(function(){
        Route::get('/index', 'index')->name('calendar.index');
        Route::post('/calendar/{meeting}', 'calendarDnD')->name('calendar.dnd');
        Route::get('/index/get-all', 'getAllMeetings')->name('calendar.get-all-meetings');
    });


    Route::resource('users', UserController::class);
    Route::resource('meetings', MeetingController::class)->except('update', 'store');
    Route::post('/meetings/update{id?}', [MeetingController::class, 'update'])->name('meetings.update');

    Route::post('/agenda-option/update/{id?}', [AgendaController::class, 'agendaOptionUpdate'])->name('agenda-option.update');
    Route::delete('/agenda/delete/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.delete');

});


Route::get('/init', [EntryController::class, 'show'])->name('init');

require __DIR__.'/auth.php';
require __DIR__.'/mobile-web.php';
