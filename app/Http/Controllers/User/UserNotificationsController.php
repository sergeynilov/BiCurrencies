<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Library\CheckValueType;
use Auth;
use Carbon\Carbon;
use DB;
use App\Models\Settings;
use App\Models\User;
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


        return Inertia::render('User/Notifications/Index', [
//            'currenciesSelectionArray' => Currency::getCurrenciesSelectionArray(),
        ]);
    }

    public function filter()
    {
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


    public function update(Request $request, $notification_id)
    {

        \Log::info(varDump($notification_id, ' -1 update $notification_id::'));

        $request = request();
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));

        $notification = null;
        try {
            DB::beginTransaction();
            $notification             = auth()->user()
                                              ->unreadNotifications()
                                              ->when($notification_id, function ($query) use ($notification_id) {
                                                  return $query->where('id', $notification_id);
                                              })
                                              ->first();
            $notification->read_at    = Carbon::now(config('app.timezone'));
            $notification->updated_at = Carbon::now(config('app.timezone'));
            $notification->save();
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 UserNotificationsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

        }

        return response()->json([
            'notification' => new NotificationResource($notification),
            'message'      => 'Notification was successfully read',
        ], HTTP_RESPONSE_OK);
    } // public function update(Reques

    /*             axios.put(route('user.notifications.update', id), {'action':'unmark'})
 */
    public function show(Request $request, $notification_id)
    {
//        \Log::info(varDump($notification_id, ' -1 show $notification_id::'));
        $notification = null;
        try {
            DB::beginTransaction();
            $notification     = auth()->user()
                                      ->unreadNotifications()
                                      ->when($notification_id, function ($query) use ($notification_id) {
                                          return $query->where('id', $notification_id);
                                      })
                                      ->first();
            $notificationUser = User::find($notification->notifiable_id);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 UserNotificationsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

        }

        return response()->json([
            'notification'     => new NotificationResource($notification),
            'notificationUser' => new UserResource($notificationUser),
            'message'          => 'Notification was successfully read',
        ], HTTP_RESPONSE_OK);
    } // public function show(Reques

    public function destroy(Request $request, $notification_id)
    {
        \Log::info(varDump($notification_id, ' -1 destroy $notification_id::'));
        try {
            DB::beginTransaction();
            $notification= auth()->user()
                  ->unreadNotifications()
                  ->when($notification_id, function ($query) use ($notification_id) {
                      return $query->where('id', $notification_id);
                  })
                  ->first();
            if($notification) {
                $notification->delete();
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UserNotificationsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

        }

        return redirect(route('user.notifications.index'))
            ->with('flash', 'You have deleted notification successfully')
            ->with('flash_type', 'success');
    }

}
