<?php

namespace App\Http\Middleware;

use App\Models\JobApply;
use Illuminate\Http\Request;
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
    public function version(Request $request): string|null
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
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'applied_jobs' => auth()->user() ? JobApply::where('user_id', auth()->id())->get()->pluck('job_id') : [],
                'app_name' => config('app.name')
            ],
            'notifications' => getNotifications(),
        ];
    }
}
