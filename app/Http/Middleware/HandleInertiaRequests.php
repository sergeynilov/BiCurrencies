<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Middleware;
use App\Models\Settings;
use App\Library\CheckValueType;

use Auth;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'adminlte';

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
            return 'layouts/adminlte'; // TODO
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

//        \Log::info(  varDump(auth()->user()->id, ' -1 SHARE auth()->user()->id::') );
        return array_merge(parent::share($request), [

//            'site_name'    => fn() => $site_name,
//            'site_heading' => fn() => $site_heading,
            'flash'        => [
                'message' => fn() => $request->session()->get('message')
            ],


            'flash_type' => [
                'message' => fn() => $request->session()->get('flash_type')
            ],

            'auth' => function () {

                $user = auth()->user();

                $is_logged_user_admin           = isUserLogged() ? auth()->user()->can(ACCESS_APP_ADMIN_LABEL) : false;
                $is_logged_user_support_manager = isUserLogged() ? auth()->user()->can(ACCESS_APP_SUPPORT_MANAGER_LABEL) : false;
                $is_logged_user_content_editor  = isUserLogged() ? auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) : false;

                return $user ? [
                    'profile'                        => $user,
                    'is_logged_user_admin'           => $is_logged_user_admin,
                    'is_logged_user_support_manager' => $is_logged_user_support_manager,
                    'is_logged_user_content_editor'  => $is_logged_user_content_editor,
                    'unread_notifications_count'     => $user->unreadNotifications()->count(),
                ] : null;
            }
        ]);
    }
}
