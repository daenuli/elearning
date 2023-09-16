<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        $logo           = Cache::get('logo');
        $logged_in_user = $request->user();
        $logo_path      = app()->isProduction() 
            ? asset('public/images/'.$logo)
            : asset('images/'.$logo);

            
        if (Auth::check()) {
        
            $new_notifications_count = DB::table('notifications')
                ->select(DB::raw('count(*) as new_notifications_count'))
                ->where('notifiable_id', student()->id)
                ->whereNull('read_at')
                ->value('new_notifications_count');
        
            $user = [
                'id' => $logged_in_user->id,  
                'name' => $logged_in_user->name,  
                'email' => $logged_in_user->email,  
                'student' => $logged_in_user->student,  
                'has_new_notifications' => $new_notifications_count > 0,
            ];
        }

        return array_merge(parent::share($request), [
            'flash' => [
                'success' => session('success'),
                'warning' => session('warning'),
                'error' => session('error'),
                'import_error' => session('import_error'),
            ],
            'auth.user' => fn () => Auth::check()
                ? $user
                : null,

            'logo' => $logo_path,
            'user_avatar' => $logged_in_user?->getAvatar(),
            'user_role' => $logged_in_user?->role->name,
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
