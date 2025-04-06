<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgendaController extends Controller
{
    // Отображение всех записей
    public function index(Request $request)
    {
        if ($request->has('page')) {
            $perPage = min($request->perPage ?? 10, 100);
            $agendas = Agenda::with('meeting')->paginate($perPage);
           return $agendas;
        }

        return Inertia::render('Agendas/Index');
    }

    // Отображение страницы для редактирования
    public function edit(Agenda $agenda)
    {
        $meetings = Meeting::all()->map(fn($meeting) => [
            'value' => $meeting->id,
            'label' => $meeting->name
        ]);

        return Inertia::render('Agendas/EditAgenda', [
            'agenda' => $agenda,
            'meetings' => $meetings
        ]);
    }

    // Страница создания новой записи
    public function create()
    {
        $meetings = Meeting::all()->map(fn($meeting) => [
            'value' => $meeting->id,
            'label' => $meeting->name
        ]);

        return Inertia::render('Agendas/CreateAgenda', [
            'meetings' => $meetings
        ]);
    }

    // Сохранение новой записи
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'meeting_id' => 'required|exists:meetings,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Agenda::create($request->all());

        return redirect()->back()->with('message', 'Agenda created successfully!');
    }

    // Обновление существующей записи
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'meeting_id' => 'required|exists:meetings,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $agenda->update($request->all());

        return redirect()->back()->with('message', 'Agenda updated successfully!');
    }

    // Удаление записи
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->back()->with('message', 'Agenda deleted successfully!');
    }
}
