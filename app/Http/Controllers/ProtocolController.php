<?php

namespace App\Http\Controllers;

use App\Models\Common\Media;
use Illuminate\Http\Request;

class ProtocolController extends Controller
{

    public function index(Request $request){

        if ($request->has('page')) {
            // Получаем количество записей на страницу (по умолчанию 10, максимум 100)
            $perPage = min($request->perPage ?? 10, 100);
            // Пагинация для модели Meeting с необходимыми отношениями
            $meetingsPaginate = Media::query()->where('module', 'protocol')->get(['id', 'original_name', 'size', 'user_id'])->load(['user']) // Добавляем отношения для подгрузки данных о председателе и секретаре
                ->paginate($perPage);
            // Возвращаем результат пагинации
            return $meetingsPaginate;
        }
    }

}
