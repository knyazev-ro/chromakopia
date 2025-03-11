<?php

use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

Route::get('/init', [EntryController::class, 'show'])->name('init');
