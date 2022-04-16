<?php

namespace App\Library\Services;

use App\Library\CheckValueType;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\ModelHasPermission;
use App\Models\Settings;
use App\Models\UserCurrencySubscription;
use App\Notifications\CurrencyRatesImportRunNotification;
use App\Notifications\SendUserCurrencySubscriptionNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use WBoyz\LaravelEnum\BaseEnum;
use App\Models\User;
use Illuminate\Console\Command;
use Exception;
use DB;

class CurrencyRatesFunctionality  // php artisan  command:importCurrencyRates
{
//    public const WATERMARK_PATH = '/img/hostels_brand_small.jpg'; //         $watermark_path = public_path    function

    private static $new_currency_rate_added = 0;

    public static function runSendUserCurrencySubscriptions(bool $from_cli = false)
    {
        $userCurrencySubscriptions = UserCurrencySubscription
//            ::with ('user')
//            ::getByUserId(auth()->user()->id)
                ::getById(2) // DEBUGGING NOT BASE CURRENCY
            ->orderBy('user_id', 'asc')
            ->get();
//            ->pluck('currency_id')
//            ->toArray();
//        \Log::info(varDump($userCurrencySubscriptions, ' -1 $userCurrencySubscriptions::'));
        $is_first              = true;
        $next_user_id       = -1;
        $nextUserCurrencies = [];
        foreach ($userCurrencySubscriptions as $nextUserCurrencySubscription) {
            if ($is_first) {
                $is_first        = false;
                $next_user_id = $nextUserCurrencySubscription->user_id;
                if(count($userCurrencySubscriptions) === 1) {
                    $nextUser = User::find($next_user_id);
                    if ( ! empty($nextUser) and $nextUser->status === 'A') {  // send email report only to active users
                        $nextUserCurrencies[] = $nextUserCurrencySubscription->currency_id;
                        self::sendEmailReport($nextUser, $nextUserCurrencies, $from_cli);
                        $nextUserCurrencies = []; // clear data for next user
                        $next_user_id       = $nextUserCurrencySubscription->user_id;
                    }
                    \Log::info(  varDump(-1, ' -1 EXIT ON FIRST::') );
                }
            } else {
                if ($next_user_id != $nextUserCurrencySubscription->user_id) {

                    $nextUser = User::find($next_user_id);
                    if ( ! empty($nextUser) and $nextUser->status === 'A') {  // send email report only to active users
                        self::sendEmailReport($nextUser, $nextUserCurrencies, $from_cli);
                        $nextUserCurrencies = []; // clear data for next user
                        $next_user_id       = $nextUserCurrencySubscription->user_id;
                    }
                }
                $nextUserCurrencies[] = $nextUserCurrencySubscription->currency_id;
            }
        }
    } // public static function runSendUserCurrencySubscriptions(bool $from_cli = false)

    private static function sendEmailReport(User $nextUser, array $nextUserCurrencies, bool $from_cli)
    {
        $currenciesList = [];
        $ret_count= 0;
        \Log::info(  varDump($nextUser->id, ' -1 sendEmailReport $nextUser->id::') );
        \Log::info(  varDump($nextUserCurrencies, ' -12 sendEmailReport $nextUserCurrencies::') );
        $rate_decimal_numbers = Settings::getValue('rate_decimal_numbers');

        foreach ($nextUserCurrencies as $next_currency_id) {
            $nextCurrency = Currency
                ::getById($next_currency_id)
                ->with('latestCurrencyHistory')
                ->first()
            ->toArray();
            \Log::info(varDump($nextCurrency, ' -1 $nextCurrency::'));
            if ( ! empty($nextCurrency) and $nextCurrency['active']) { // In report only active currencies
                \Log::info(  varDump($nextCurrency['latest_currency_history'], ' -1 $nextCurrency->latest_currency_history::') );

                $currency_value = $nextCurrency['latest_currency_history']['value'] ?? 0;
//                number_format($a, $rate_decimal_numbers, '.', ""); // 2.423
                $currenciesList[] = [
                    'currency_id' => $nextCurrency['id'],
                    'currency_name' => $nextCurrency['name'],
                    'currency_char_code' => $nextCurrency['char_code'],
                    'currency_value' => number_format($currency_value, $rate_decimal_numbers, '.', "") // TOFIX
                ];
            }

        }

        \Log::info(  varDump($currenciesList, ' -1 $currenciesList::') );
        $base_currency_code       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        $operation_date = Carbon::now(config('app.timezone'))->format('Y-m-d' );
        $nextUser->notify(new SendUserCurrencySubscriptionNotification(
            from_cli: $from_cli,
            user: $nextUser,
            currenciesList:$currenciesList,
            base_currency_code:$base_currency_code,
            operation_date: $operation_date
        ) );

        return $ret_count;
    } // private function sendEmailReport(User $nextUser, array $nextUserCurrencies)


    public static function runImportCurrencyRates(bool $from_cli = false, int $user_id= null, $send_email_to_admins= false)
    {
        if($send_email_to_admins) {
            $site_name         = Settings::getValue('site_name', CheckValueType::cvtString, '');
            $support_signature = 'Yours truly, ' . $site_name . ' support';

            $myEmail      = 'nilovsergey@yahoo.com';
            $additiveVars = [
                'support_signature' => $support_signature,
            ];
            $ccEmail      = 'nilov@softreactor.com';
            $title        = 'Currency rates import run at ' . $site_name;
        }


        $base_currency_code       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
//        \Log::info(  varDump($base_currency_code, ' -1 $base_currency_code::') );

        if( empty($base_currency_code) ) {
//            echo "Main currency is not set.  Check Settings page ! \n";
//            \Mail::to($myEmail)->cc([$ccEmail])->send(new currencyRatesImportEmail($title .' with errors ', false, 'Main currency is not set.  Check Settings page !', $additiveVars));
            return -1;
        }

//        \Log::info(  varDump($base_currency_code, ' -1$$base_currency_code::') );

        $operation_date = Carbon::now(config('app.timezone'))->format('Y-m-d' );
//        \Log::info( '-1 $operation_date ::' . print_r( $operation_date, true  ) );
        if(empty($operation_date)) {
            abort(403, 'Operation Date is not set.');
        }


        $req_url = 'https://api.exchangerate.host/latest?base=' . $base_currency_code;
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
//                    var_dump($response);
                    if(!empty($response->rates)) {
                        $rates=  (array)$response->rates;
                        self::writeRatesIntoDb($operation_date, $rates);
                    }
                }
            } catch(Exception $e) {
                abort(403, print_r($e->getMessage(), true));
            }
        }
        //     public function __construct(bool $from_cli, User $user= null)
        $admins= ModelHasPermission
            ::getByPermissionId(ACCESS_APP_ADMIN)
            ->with('user')
            ->get();
//        \Log::info(  varDump($admins, ' -1 $admins::') );
        foreach( $admins as $nextAdmin ) {
            $nextAdmin->user->notify(new CurrencyRatesImportRunNotification(
                from_cli: $from_cli,
                user_id:$user_id,
                new_currency_rate_added:self::$new_currency_rate_added,
                base_currency_code:$base_currency_code,
                operation_date: $operation_date) );
        }

        return [
            'new_currency_rate_added'=>self::$new_currency_rate_added,
            'base_currency_code'=> $base_currency_code,
            'operation_date'=> $operation_date,
            ];
    } // public static function runImportCurrencyRates()
    private static function writeRatesIntoDb($operation_date, $rates) {
        try {
            $newCurrencyAdded= 0;
            self::$new_currency_rate_added= 0;
            DB::beginTransaction();
            foreach ($rates as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows
                $currency = Currency::getByCharCode($currencyRateRowCharCode)->first();
                if(empty($currency)) continue;
                $currencyHistory = CurrencyHistory
                    ::getByDay($operation_date)
                    ->getByCurrencyId($currency->id)
                    ->first();
                if(!empty($currencyHistory)) continue;

                $currencyHistory               = new CurrencyHistory();
                $currencyHistory->currency_id  = $currency->id;
                $currencyHistory->day          = $operation_date;
                $currencyHistory->nominal      =  1;
                $currencyHistory->value        = str_replace(',','.',(string)$currencyRateRowValue);   // value: '55,9618' fo
                $currencyHistory->save();
                self::$new_currency_rate_added++;
            } // foreach ($currencyRateRows as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows

//            $successMsg= "New currencies added  : " . $newCurrencyAdded . ', new currency rates added : ' . self::$new_currency_rate_added . "\n";
//            \Mail::to($myEmail)->send(new currencyRatesImportEmail($title .' with success ', true, $successMsg, $additiveVars));

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'tag' => null], 500);
        }

    }


}


