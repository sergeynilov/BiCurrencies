<?php

namespace App\Http\Controllers\Admins;

// use App\Http\Controllers\Admins\AdminDashboardController;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyHistoryResource;
use App\library\CheckValueType;
use App\Models\CMSItem;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use App\Models\UserCurrencySubscription;
use App\Models\User;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class AdminDashboardController extends Controller // http://127.0.0.1:8000/admin/dashboard
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $ago = $now->subDays(3);

        return Inertia::render('Admins/Dashboard', [
            'users' => User::whereDate('created_at', '>', $ago)->count()
        ]);
    }

    public function get_currency_info()
    {
//        \Log::info(varDump(-1, ' -1 get_currency_info -1::'));
        $active_currencies_count   = Currency
            ::getByActive(true)
            ->count();
        $inactive_currencies_count = Currency
            ::getByActive(0)
            ->count();
        $all_currencies_count      = Currency::count();

        $all_currencies_histories_count = CurrencyHistory::count();

//        \Log::info(varDump($all_currencies_histories_count, ' -1 $all_currencies_histories_count::'));
        return response()->json([
            'active_currencies_count'        => $active_currencies_count,
            'inactive_currencies_count'      => $inactive_currencies_count,
            'all_currencies_count'           => $all_currencies_count,
            'all_currencies_histories_count' => $all_currencies_histories_count,
        ], HTTP_RESPONSE_OK);
    } // public function get_currency_info()


    public function get_users_info()
    {
        \Log::info(varDump(-1, ' -1 get_users_info -1::'));
        // N => New(Waiting activation), A=>Active, I=>Inactive
        $active_users_count   = User
            ::getByStatus('A') // Active
            ->count();
        $inactive_users_count = User
            ::getByStatus('I') // Inactive
            ->count();
        $new_users_count      = User
            ::getByStatus('N') // New
            ->count();
        $all_users_count      = User::count();

        return response()->json([
            'active_users_count'   => $active_users_count,
            'inactive_users_count' => $inactive_users_count,
            'new_users_count'      => $new_users_count,
            'all_users_count'      => $all_users_count,
            //            'all_currencies_histories_count'=> $all_currencies_histories_count,
        ], HTTP_RESPONSE_OK);
    } // public function get_users_info()


    /*
Route::get('dashboard/get_user_currency_subscriptions_info', [AdminDashboardController::class, 'get_user_currency_subscriptions_info'])->name('dashboard.get_users_info');
*/

    public function get_user_currency_subscriptions_info()
    {
        \Log::info(varDump(-1, ' -1 get_user_currency_subscriptions_info -1::'));

        $userCurrencySubscriptions     = [];
        $tempUserCurrencySubscriptions = UserCurrencySubscription
//            ::orderBy('cms_items_count', 'desc')->orderBy('author_id', 'asc')
            ::select('currency_id', DB::raw('count(*) as currency_subscriptions_count'))
            ->groupBy('currency_id')
            ->orderBy('currency_subscriptions_count', 'desc')
            ->havingRaw('count(*) >= 1')
            ->limit(100)
            ->get();

//        \Log::info(varDump($tempUserCurrencySubscriptions, ' -1 $tempUserCurrencySubscriptions::'));

        foreach ($tempUserCurrencySubscriptions as $next_key => $nextTempUserCurrencySubscription) {
            $nextCurrency             = Currency::find($nextTempUserCurrencySubscription['currency_id']);
            $currency_media_image_url = '';
            if ($nextCurrency) {
                $has_image= false;
                foreach ($nextCurrency->getMedia(config('app.media_app_name')) as $mediaImage) {
//                \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath())::'));
                    if (File::exists($mediaImage->getPath())) {
                        \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                        $currency_media_image_url = $mediaImage->getUrl();
                        $has_image                = true;
                        break;
                    }
                }
                if ( ! $has_image) {
                    $currency_media_image_url = '/images/default-currency.jpg';
                }

                $userCurrencySubscriptions[] = [
                    'currency_subscriptions_count' => $nextTempUserCurrencySubscription['currency_subscriptions_count'],
                    'currency_media_image_url'     => $currency_media_image_url,
                    'currency_name'               => $nextCurrency->name,
                    'currency_char_code'           => $nextCurrency->char_code,
                    'currency_id'                  => $nextCurrency->id,
                ];
            }


        }
        /*        $authors = CMSItem
        //            ::orderBy('cms_items_count', 'desc')->orderBy('author_id', 'asc')
                    ::select('author_id', DB::raw('count(*) as cms_items_count'))
                    ->groupBy('author_id')
                    ->orderBy('cms_items_count', 'desc')
                    ->havingRaw('count(*) >= 1')
                    ->get();*/

        /*        $active_currencies_count        = Currency
                    ::getByActive(true)
                    ->count();
                $inactive_currencies_count        = Currency
                    ::getByActive(0)
                    ->count();
                $all_currencies_count        = Currency::count();

                $all_currencies_histories_count = CurrencyHistory::count();*/
//        \Log::info(varDump($all_currencies_histories_count, ' -1 $all_currencies_histories_count::'));
//        \Log::info(varDump($userCurrencySubscriptions, ' -1 $userCurrencySubscriptions::'));

        return response()->json([
            'userCurrencySubscriptions' => $userCurrencySubscriptions,
        ], HTTP_RESPONSE_OK);
    } // public function get_user_currency_subscriptions_info()


}
