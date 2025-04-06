<?php

namespace App\Http\Controllers;

use App\Enums\MeetingFormatType;
use App\Models\Agenda;
use App\Models\AgendaOption;
use App\Models\Branch;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MeetingController extends Controller
{

 // Показать список встреч
 public function index(Request $request)
 {
     // Проверяем, есть ли в запросе параметр 'page'
     if ($request->has('page')) {
         // Получаем количество записей на страницу (по умолчанию 10, максимум 100)
         $perPage = min($request->perPage ?? 10, 100);

         // Пагинация для модели Meeting с необходимыми отношениями
         $meetingsPaginate = Meeting::with(['chairman', 'secretary', 'agenda']) // Добавляем отношения для подгрузки данных о председателе и секретаре
             ->paginate($perPage);

         // Возвращаем результат пагинации
         return $meetingsPaginate;
     }

     // Если нет параметра 'page', рендерим страницу с Inertia
     return Inertia::render('Meetings/Index'); // Путь к твоему компоненту с таблицей встреч
 }
    // Показать форму для создания новой встречи
    public function create()
    {
        $meetingTypes = MeetingFormatType::all();
        $branches = Branch::all()->map(fn($e) => ['value' => $e->id, 'label' => $e->name]);
        return Inertia::render('Meetings/EditMeeting', compact( 'meetingTypes', 'branches'));
    }

    // Сохранить новую встречу
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format_type' => 'required|integer',
            'chariman_id' => 'required|exists:users,id',
            'secretaty_id' => 'required|exists:users,id',

        ]);

        $meeting = Meeting::create($request->all());

        return Redirect::back()->with('message', 'Успешно сохранено');
    }

    // Показать конкретную встречу
    public function show(Meeting $meeting)
    {
        $meeting->load(['agenda', 'chairman', 'secretary']);
        $meetingTypes = MeetingFormatType::all();
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

        return Inertia::render('Meetings/Meeting', compact('meeting', 'meetingTypes', 'agenda'));
    }

    // Показать форму для редактирования встречи
    public function edit(Meeting $meeting)
    {
        $meeting->load(['agenda', 'chairman', 'secretary']);
        $meetingTypes = MeetingFormatType::all();
        $branches = Branch::all()->map(fn($e) => ['value' => $e->id, 'label' => $e->name]);
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
        return Inertia::render('Meetings/EditMeeting', compact('meeting', 'meetingTypes', 'branches', 'agenda'));
    }

    // Обновить информацию о встрече
    public function update(Request $request, int|null $id=null)
    {
        // dd($request->all());
        $validated = $request->validate([
            // Валидация основных данных встречи
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'format_type' => 'required|integer|in:1,2,3', // Предполагая, что это enum значения
            'chairman_id' => 'nullable',
            'secretary_id' => 'nullable',
            'branch_id' => 'required|exists:branches,id',
            
            // Валидация данных повестки
            'agenda' => 'required|array',
            'agenda.name' => 'required|string|max:255',
            'agenda.start_date' => 'required|date',
            'agenda.end_date' => 'required|date|after:agenda.start_date',
            'agenda.options' => 'nullable|array',
            'agenda.options.*.question' => 'required|string|max:1000',
            'agenda.options.*.agreed' => 'array',
            'agenda.options.*.agreed.*' => 'integer|exists:users,id',
            'agenda.options.*.against' => 'array',
            'agenda.options.*.against.*' => 'integer|exists:users,id',
            'agenda.options.*.abstained' => 'array',
            'agenda.options.*.abstained.*' => 'integer|exists:users,id',
            'agenda.options.*.attachments' => 'array',
        ]);
        
        // Обработка данных...
        $meeting = Meeting::updateOrCreate(['id' => $id], $validated);
        
        // Обработка повестки
        if ($request->has('agenda')) {
            $this->updateAgenda($meeting, $request->agenda);
        }
    
        return redirect()->route('meetings.show', $meeting);
    }
    
    protected function updateAgenda(Meeting $meeting, array $agendaData)
    {
        $agenda = $meeting->agenda()->updateOrCreate([], [
            'name' => $agendaData['name'],
            'start_date' => $agendaData['start_date'],
            'end_date' => $agendaData['end_date'],
        ]);
    
        foreach ($agendaData['options'] as $option) {
            $agenda->agendaOptions()->updateOrCreate(
                ['question' => $option['question']],
                [
                    'agreed' => $option['agreed'],
                    'against' => $option['against'],
                    'abstained' => $option['abstained'],
                    'attachments' => $option['attachments'],
                ]
            );
        }
    }

    // Удалить встречу
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return Redirect::to(route('calendar.index')); 
    }


}
