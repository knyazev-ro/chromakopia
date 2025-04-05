<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return Inertia::render('Pages/MeetingCalendar', compact('meetings'));
    }
}
