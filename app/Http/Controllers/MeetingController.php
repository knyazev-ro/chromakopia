<?php

namespace App\Http\Controllers;

use App\Enums\MeetingFormatType;
use App\Models\Meeting;
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
        // Логика для создания встречи (например, отдать форму)
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
        return response()->json($meeting);
    }

    // Показать форму для редактирования встречи
    public function edit(Meeting $meeting)
    {
        $meeting->load(['agenda', 'chairman', 'secretary']);
        $meetingTypes = MeetingFormatType::all();
        return Inertia::render('Meetings/EditMeeting', compact('meeting', 'meetingTypes'));
    }

    // Обновить информацию о встрече
    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format_type' => 'required|integer',
            'chariman_id' => 'required|exists:users,id',
            'secretaty_id' => 'required|exists:users,id',
        ]);

        $meeting->update($request->all());

        return response()->json($meeting);
    }

    // Удалить встречу
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return response()->json(null, 204); // Возвращаем 204 No Content
    }


}
