<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

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
        $layout = $this->resolveLayout($request);
        Session::put('layout', $layout);
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'layout' => $layout,
        ];
    }

    protected function resolveLayout(Request $request):bool{
        return (bool)collect(explode('.', Route::currentRouteName()))->filter(fn($e) => $e === 'mb')->count();
    }

}
