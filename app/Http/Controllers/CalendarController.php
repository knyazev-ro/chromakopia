<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AgendaOption;
use App\Models\Meeting;
use App\Models\User;
use Carbon\Carbon;
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

    public function closestMeeting(){
        $meeting = Meeting::where('branch_id', Auth::user()->branch_id)
        ->where('director_type', Auth::user()->type)->where('start_date', '>', Carbon::now())->orderBy('start_date', 'asc')->first();
        
        $agenda = Agenda::query()->where('meeting_id', $meeting->id)
        ->first();
        if($agenda){
            $agenda->load('agendaOptions');
            $agenda->agendaOptions = $agenda->agendaOptions->map(function(AgendaOption $option){
                $option->setAttribute('agreed', User::whereIn('id', $option->agreed)->get());
                $option->setAttribute('against', User::whereIn('id', $option->against)->get());
                $option->setAttribute('abstained', User::whereIn('id', $option->abstained)->get());
                return $option;
            });
        }

        return Inertia::render('CalendarLatest', compact('meeting', 'agenda'));
    }
}
