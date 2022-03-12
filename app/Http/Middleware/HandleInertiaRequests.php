<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Settings;
use App\Library\CheckValueType;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        \Log::info(  varDump($request->session()->get('message'), ' -1 HandleInertiaRequests $request->session()->get(message)::') );
//        \Log::info(  varDump($request->session()->get('flash_type'), ' -1 HandleInertiaRequests $request->session()->get(flash_type)::') );
        return array_merge(parent::share($request), [


//            'flash' => [
//                'message' => fn () => 'Some testing message here 987'
//            ],
//            'flash_type' => [
//                'message' => fn () => 'Testing if it will show'
//            ],
//'flash' => [
//    'message' => fn () => $request->session()->get('message')
//],


            'auth' => function() {
                $user = auth()->user();
                $site_name = Settings::getValue('site_name', CheckValueType::cvtString, 'Admin demo');

                return $user ? [
                    'profile' => $user,
                    'site_name' => $site_name,
                    'notifications' => [],// $user->notifications,
                    'readNotifications' => [],// $user->readNotifications,
//                    'unreadNotificationsCount'=> $user->unreadNotifications()->count(),
                ] : null;
            }
        ]);
    }
}
