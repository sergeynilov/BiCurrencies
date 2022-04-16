<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\CurrencyResource;
use App\Http\Resources\UserCurrencySubscriptionResource;
use App\Http\Resources\UserResource;
use App\Library\CheckValueType;
use App\Models\Currency;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use App\Models\Settings;
use App\Models\User;
use App\Models\UserCurrencySubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class UserCurrencySubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! isUserLogged()) {
            return redirect(route('login'))
                ->with('flash', 'You are not logged')
                ->with('flash_type', 'error');
        }

        $userCurrencySubscriptions = UserCurrencySubscription
            ::getByUserId(auth()->user()->id)
            ->get()
            ->pluck('currency_id')
        ->toArray();
//        \Log::info(varDump($userCurrencySubscriptions, ' -1 filter $userCurrencySubscription::'));

        $currencies = Currency
            ::getByActive(true)
//            ->getById(8) // DEBUG
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($currencyItem) use ($userCurrencySubscriptions) {
                if(in_array($currencyItem->id, $userCurrencySubscriptions)) {
                    $currencyItem->is_selected = true;

                }
                return $currencyItem;
            })
            ->all();
        return $currencies;
//        return (UserCurrencySubscriptionResource::collection($userCurrencySubscriptions));
    }

    public function store(Request $request)
    {
        $userCurrencySubscription = null;
        try {
            DB::beginTransaction();
            $userCurrencySubscription = UserCurrencySubscription::create([
                'currency_id'      => $request->currency_id,
                'user_id' => auth()->user()->id,
            ]);
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);

        }
//        \Log::info('-1 store $UserCurrencySubscription->id::' . print_r($userCurrencySubscription->id, true));
        return response()->json([
            'message' => '',
            'userCurrencySubscription' => $userCurrencySubscription,
        ], HTTP_RESPONSE_OK_RESOURCE_CREATED);


        /* route('admin.cms_items.index') */
    }


    public function destroy(Request $request, $currency_id)
    {
//        \Log::info(varDump($currency_id, ' -1 destroy $currency_id::'));

        $userCurrencySubscription = UserCurrencySubscription
            ::getByCurrencyId($currency_id)
            ->getByUserId(auth()->user()->id)
            ->first();
        if ($userCurrencySubscription == null) {
//            \Log::info(varDump($userCurrencySubscription, ' $userCurrencySubscription destroy  $currency_id::'));
            return response()->json([
                'message' => 'User Currency Subscription # "' . $currency_id . '/'. auth()->user()->id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }
        try {
            DB::beginTransaction();
            $userCurrencySubscription->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

    }

}
