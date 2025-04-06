<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AgendaOption;
use App\Models\Meeting;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AgendaController extends Controller
{

    public function __construct(protected MediaService $mediaService) {
    }


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
            'agenda_option_id' => 'integer|nullable'
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

    public function agendaOptionUpdate(Request $request, int|null $id=null){
        $validated = $request->validate([
            'agenda_id' => 'integer|exists:agendas,id',
            'agreed' => 'array|nullable',
            'against' => 'array|nullable',
            'abstained' => 'array|nullable',
            'attachments' => 'array|nullable',
            'type' => 'integer|nullable',
        ]);

        $currentUserId = Auth::id();

        if($id){
            $agendaOption = AgendaOption::findOrFail($id);
            $agreed = array_values(array_filter($agendaOption->agreed, fn($e) => $e !== $currentUserId));
            $against = array_values(array_filter($agendaOption->against, fn($e) => $e !== $currentUserId));
            $abstained = array_values(array_filter($agendaOption->abstained, fn($e) => $e !== $currentUserId));
            // $agendaOption->attachments = $this->mediaService->handleFileUploads($$validated['attachments'], 'AgendaOption', 'agenda');
            
            match($validated['type']){
                1 => $agreed[] = $currentUserId,//ЗА
                2 => $against[] = $currentUserId,//Против
                3 => $abstained[] = $currentUserId,//Воздержались
            };

            $agendaOption->agreed = $agreed;
            $agendaOption->against = $against; 
            $agendaOption->abstained = $abstained; 

            $agendaOption->save();
        } else {

            AgendaOption::create($validated);
        }

        return Redirect::back();


    }
}
