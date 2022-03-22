<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\NotificationResource;
use App\Library\CheckValueType;
use Auth;
use DB;
use App\Models\Settings;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }

        return Inertia::render('User/Notifications/Index', [
//            'currenciesSelectionArray' => Currency::getCurrenciesSelectionArray(),
        ]);
    }

    public function filter()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }
        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($backend_items_per_page, ' -1 filter $backend_items_per_page::'));

        $request = request();
        \Log::info('-1 UserNotificationsController $request->all()::' . print_r($request->all(), true));


        $page                             = $request->page ?? 1;
        $filter_only_unread_notifications = $request->filter_only_unread_notifications ?? 1;
        \Log::info(varDump($filter_only_unread_notifications, ' -1 filter ::: $filter_only_unread_notifications::'));


        if ($filter_only_unread_notifications) {
            \Log::info(varDump($filter_only_unread_notifications,
                ' -1234 filter ::: $filter_only_unread_notifications::'));
            $notificationsData = auth()->user()->unreadNotifications()->latest()->paginate();
        } else {
            \Log::info(varDump($filter_only_unread_notifications,
                ' -9999 filter ::: $filter_only_unread_notifications::'));
            $notificationsData = auth()->user()->notifications()->latest()->paginate();
        }

//        \Log::info(  varDump(NotificationResource::collection($notificationsData), ' -1 $notificationsData::') );
        return (NotificationResource::collection($notificationsData));
    } // public function filter()



    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ad $ad
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $notification_id)
    {
        \Log::info(varDump($notification_id, ' -1 destroy $notification_id::'));
        try {
            DB::beginTransaction();
            auth()->user()
                  ->unreadNotifications()
                  ->when($notification_id, function ($query) use ($notification_id) {
                      return $query->where('id', $notification_id);
                  })
                  ->markAsRead();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UserNotificationsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return $request->wantsJson()
                ? new JsonResponse($ad, 500 /*HTTP_RESPONSE_INTERNAL_SERVER_ERROR*/)
                : back()->with('status', 'Error adding ad : ' . $e->getMessage());

            return;
        }

        \Log::info(varDump($ad->id, ' -1 $ad->id::'));

        return $request->wantsJson()
            ? new JsonResponse($ad, HTTP_RESPONSE_OK)
            : back()->with('status', 'Ad saved succesully');
    }
}
