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
                'href' => '',
            ],
            [
                'title' => 'Новое заседание',
                'icon' => '',
                'href' => '',
            ],
            [
                'title' => 'Пользователи',
                'icon' => '',
                'href' => '',
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
                // href => route()
            ],
            [
                'title' => "Ближайшие заседания",
                'icon' => '',
                // href => route()
            ],
            [
                'title' => "Уведомления",
                'icon' => '',
                // href => route()
            ],
            [
                'title' => "Протоколы",
                'icon' => '',
                // href => route()
            ],
            [
                'title' => "Опросники",
                'icon' => '',
                // href => route()
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
