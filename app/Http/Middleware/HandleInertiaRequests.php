<?php

namespace App\Http\Middleware;

use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Inertia\Middleware;
use Lauthz\Facades\Enforcer;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $layout = $this->resolveLayoutStyle($request);
        Session::put('layout_style', $layout);

        $this->resolveLayout($request);


        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'menu' => MenuService::menu($request),
            'layout' => $layout,
        ];
    }

    protected function resolveLayoutStyle(Request $request):bool{
        return (bool)collect(explode('.', Route::currentRouteName()))->filter(fn($e) => $e === 'mb')->count();
    }

    protected function resolveLayout(Request $request){
        $user = Auth::user() ?? null;
        if(!$user)
            return;
        
        $perms = collect(Enforcer::getImplicitPermissionsForUser("U$user->id"))
            ->filter(fn($e) => Str::after($e[1], "_") === "MENU" && $e[2] === "access")
            ->map(fn($e) => $e[1])
            ->values()
            ->toArray();
        Session::put('layout', $perms[0]);
    }

}
