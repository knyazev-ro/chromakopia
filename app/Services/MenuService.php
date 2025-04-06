<?php


namespace App\Services;

use App\Enums\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuService
{

    public static function AdministratorMenu(Request $request)
    {

        $menu = [
            [
                'title' => "Календарь заседаний",
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => "Создать заседание",
                'icon' => '',
                'href' => 'meetings.create',
            ],
            [
                'title' => 'Протоколы',
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => 'Пользователи',
                'icon' => '',
                'href' => 'users.index',
            ],
        ];

        return $menu;
    }

    public static function DirectorsMenu(Request $request)
    {
        $menu = [
            [
                'title' => "Календарь заседаний",
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => "Ближайшие заседания",
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => "Уведомления",
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => "Протоколы",
                'icon' => '',
                'href' => 'calendar.index',
            ],
            [
                'title' => "Опросники",
                'icon' => '',
                'href' => 'calendar.index',
            ]
        ];

        return $menu;
    }

    public static function menu(Request $request)
    {
        $layout = Session::get('layout');

        return match ($layout) {
            RoleType::ADMIN->value . "_MENU" => MenuService::AdministratorMenu($request),
            RoleType::DIRECTOR->value . "_MENU" => MenuService::DirectorsMenu($request),
            RoleType::COMMITET_DIRECTOR->value . "_MENU" => MenuService::DirectorsMenu($request),
            default => [],
        };
    }
}
