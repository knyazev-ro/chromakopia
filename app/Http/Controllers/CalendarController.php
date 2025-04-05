<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CalendarController extends Controller
{
    public function index(): \Inertia\Response
    {
        $meetings = Meeting::all();
        return Inertia::render('MeetingCalendar', compact('meetings'));
    }

    public function calendarDnD(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'start' => 'required|date',
        ]);

        $meeting->start_date = $validated['start'];
        $meeting->save();

        return Redirect::back();
    }
}
