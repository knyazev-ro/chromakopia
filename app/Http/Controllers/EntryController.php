<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class EntryController extends Controller
{
    public function show(): \Inertia\Response
    {
        return Inertia::render('Entry');
    }
}
