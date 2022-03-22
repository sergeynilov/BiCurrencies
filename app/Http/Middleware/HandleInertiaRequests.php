<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Middleware;
use App\Models\Settings;
use App\Library\CheckValueType;

use Jenssegers\Agent\Agent;
use Laravel\Fortify\Fortify;
//use Illuminate\Support\Facades\Auth;
use Auth;


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
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function rootView(Request $request)
    {
//        \Log::info(varDump($request->segment(1), ' -1 rootView $request->segment(1)::'));

        if ($request->segment(1) == 'user') {
            return 'layouts/user';
        }
        if ($request->segment(1) == 'admin') {
            return 'layouts/app'; // TODO
        }

        return 'layouts/frontend'; // Current request is front-end
//        return parent::rootView($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function share(Request $request): array
    {
        \Log::info(varDump($request->session()->get('message'),
            ' -1 HandleInertiaRequests $request->session()->get(message)::'));
//        \Log::info(  varDump($request->session()->get('flash_type'), ' -1 HandleInertiaRequests $request->session()->get(flash_type)::') );


/*        \Log::info(varDump(auth()->user(), ' -1 $authUser::'));
        if (auth()->user()->status !== 'A') {

//            Inertia.post(route('logout'));

//            auth()->user()->logout();
            Auth::logout();
//            $this->guard()->logout();
//            auth()->logout();
            throw ValidationException::withMessages([
                Fortify::username() => "Account is not active",
            ]);
            return redirect('/login');


        }*/

        return array_merge(parent::share($request), [

            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],

            //            'flash' => [
            //                'message' => fn () => 'Some testing message here 987'
            //            ],
            //            'flash_type' => [
            //                'message' => fn () => 'Testing if it will show'
            //            ],
            //'flash' => [
            //    'message' => fn () => $request->session()->get('message')
            //],


            'auth' => function () {
                $user      = auth()->user();
                $site_name = Settings::getValue('site_name', CheckValueType::cvtString, 'Admin demo');

                $agent        = new Agent();
                $agent_device = '';
                if ($agent->isMobile()) {
                    $agent_device = 'mobile';
                }
                if ($agent->isTablet()) {
                    $agent_device = 'tablet';
                }

//                \Log::info(  varDump($agent, ' -1 $agent::') );
//                \Log::info(  varDump($agent_device, ' -1 $agent_device::') );
//                \Log::info(  varDump($user->unreadNotifications()->count(), ' -1 $user->unreadNotifications()->count()::') );
                return $user ? [
                    'profile'                    => $user,
                    'site_name'                  => $site_name,
                    'agent_device'               => $agent_device,
                    //                    'notifications' => [],// $user->notifications,
                    //                    'readNotifications' => [],// $user->readNotifications,
                    'unread_notifications_count' => $user->unreadNotifications()->count(),
                ] : null;
            }
        ]);
    }
}
