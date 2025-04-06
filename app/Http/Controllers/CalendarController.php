<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CalendarController extends Controller
{
    public function index(): \Inertia\Response
    {
        $meetings = Meeting::where('branch_id', Auth::user()->branch_id)
            ->where('director_type', Auth::user()->type)->get();
        return Inertia::render('MeetingCalendar', compact('meetings'));
    }

    
    public function getAllMeetings(): \Inertia\Response
    {
        $meetings = Meeting::where('branch_id', Auth::user()->branch_id)->get();
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
