<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\CheckValueType;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use Carbon\Carbon;
use Exception;
use DB;


class FillImportCurrencyRatesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FillImportCurrencyRatesData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    public function handle()
    {
        // // php artisan  command:FillImportCurrencyRatesData
        $site_name = Settings::getValue('site_name', CheckValueType::cvtString, '');
        $support_signature = 'Yours truly, ' . $site_name . ' support';

        $myEmail = 'nilovsergey@yahoo.com';
        $additiveVars = [
            'support_signature' => $support_signature,
        ];
        $ccEmail= 'nilov@softreactor.com';
        $title        = 'Currency rates import run at ' . $site_name;

        $base_currency_code       = Settings::getValue('base_currency', CheckValueType::cvtString, '');

        if( empty($base_currency_code) ) {
            echo "Main currency is not set.  Check Settings page ! \n";
//            \Mail::to($myEmail)->cc([$ccEmail])->send(new currencyRatesImportEmail($title .' with errors ', false, 'Main currency is not set.  Check Settings page !', $additiveVars));
            return -1;
        }

        \Log::info(  varDump($base_currency_code, ' -1$$base_currency_code::') );

        $operationDate = Carbon::now(config('app.timezone'))->format('Y-m-d' );
//        \Log::info( '-1 $operationDate ::' . print_r( $operationDate, true  ) );
        if(empty($operationDate)) {
            abort(403, 'Operation Date is not set.');
        }
        $year= 2021;
        $month= 3;
        $day= 9;
        $operationDate= Carbon::createFromDate($year, $month, $day, config('app.timezone'));
        $i= 0;

        while($operationDate->lte( Carbon::now(config('app.timezone'))) ) {
            // var requestURL = 'https://api.exchangerate.host/2020-04-04';
//            $req_url       = 'https://api.exchangerate.host/latest?base=USD';
            $req_url       = 'https://api.exchangerate.host/' . ($operationDate->format('Y-m-d')).'?base=' . $base_currency_code;
            $response_json = file_get_contents($req_url);
            if (false !== $response_json) {
                try {
                    $response = json_decode($response_json);
                    if ($response->success === true) {
//                    \Log::info(  varDump($response, ' -13 $response::') );
                        if ( ! empty($response->rates)) {
                            $rates = (array)$response->rates;
                            $this->writeRatesIntoDb($operationDate, $rates);
                        }
                    }
                } catch (Exception $e) {
                    abort(403, print_r($e->getMessage(), true));
                }
            }
//            echo 'writeRatesIntoDb $i::' . $i;
//            echo 'writeRatesIntoDb $month::' . $month;

            if($i > 30) {
                $month++;
                $i= 0;
            } else {
                $i++;
            }
//            echo 'AFYETR writeRatesIntoDb $i::' . $i;
//            echo 'AFYETR writeRatesIntoDb $month::' . $month;

            $operationDate= Carbon::createFromDate($year, $month, $day+$i, config('app.timezone'));
        }
        return 0;

    }

    private function writeRatesIntoDb($operationDate, $rates) {
        $base_currency_code       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        echo 'writeRatesIntoDb $operationDate::' . $operationDate;
        try {
            $newCurrencyAdded= 0;
            $newCurrencyRateAdded= 0;
            DB::beginTransaction();
            foreach ($rates as $currency_rate_row_char_code => $currency_rate_row_value) { // all currency rate rows
                if($base_currency_code === $currency_rate_row_char_code) { // skip base currency
                    continue;
                }
                $currency = Currency::getByCharCode($currency_rate_row_char_code)->first();
                if(empty($currency)) continue;
                $currencyHistory = CurrencyHistory
                    ::getByDay($operationDate)
                    ->getByCurrencyId($currency->id)
                    ->first();
                if(!empty($currencyHistory)) continue;

                $currencyHistory               = new CurrencyHistory();
                $currencyHistory->currency_id  = $currency->id;
                $currencyHistory->day          = $operationDate;
                $currencyHistory->nominal      =  1;
                $currencyHistory->value        = str_replace(',','.',(string)$currency_rate_row_value);   // value: '55,9618' fo
                $currencyHistory->save();
                $newCurrencyRateAdded++;
            } // foreach ($currencyRateRows as $currency_rate_row_char_code => $currencyRateRowValue) { // all currency rate rows

            $successMsg= "  New currencies added  : " . $newCurrencyAdded . ', new currency rates added : ' . $newCurrencyRateAdded . "\n";
            echo $successMsg;
//            \Mail::to($myEmail)->send(new currencyRatesImportEmail($title .' with success ', true, $successMsg, $additiveVars));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'tag' => null], 500);
        }

    }

/*    public function handle()
    { // php artisan  command:FillImportCurrencyRatesData
        $site_name = Settings::getValue('site_name', CheckValueType::cvtString, '');
        $support_signature = 'Yours truly, ' . $site_name . ' support';

        $myEmail = 'nilovsergey@yahoo.com';
        $additiveVars = [
            'support_signature' => $support_signature,
        ];
        $ccEmail= 'nilov@softreactor.com';
        $title        = 'Currency rates import run at ' . $site_name;

        $baseCurrencyCode       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        \Log::info(  varDump($baseCurrencyCode, ' -1 $baseCurrencyCode::') );

        if( empty($baseCurrencyCode) ) {
            echo "Main currency is not set.  Check Settings page ! \n";
//            \Mail::to($myEmail)->cc([$ccEmail])->send(new currencyRatesImportEmail($title .' with errors ', false, 'Main currency is not set.  Check Settings page !', $additiveVars));
            return -1;
        }

        \Log::info(  varDump($baseCurrencyCode, ' -1$$baseCurrencyCode::') );

        $operationDate = Carbon::now(config('app.timezone'))->format('Y-m-d' );
//        \Log::info( '-1 $operationDate ::' . print_r( $operationDate, true  ) );
        if(empty($operationDate)) {
            abort(403, 'Operation Date is not set.');
        }

        // 2021-03-08 15:50:54


//        $req_url = 'https://api.exchangerate.host/latest?base=USD';
        $req_url = 'https://api.exchangerate.host/latest?base=USD';
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
//                    \Log::info(  varDump($response, ' -13 $response::') );
                    var_dump($response);
                    if(!empty($response->rates)) {
                        $rates=  (array)$response->rates;
                        $this->writeRatesIntoDb($operationDate, $rates);
//                        \Log::info(  varDump($rates, ' -1 $rates::') );
                    }
                }
            } catch(Exception $e) {
                abort(403, print_r($e->getMessage(), true));
            }
        }
        return 0;

    }

    private function writeRatesIntoDb($operationDate, $rates) {
        try {
            $newCurrencyAdded= 0;
            $newCurrencyRateAdded= 0;
            DB::beginTransaction();
            foreach ($rates as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows
                $currency = Currency::getByCharCode($currencyRateRowCharCode)->first();
                if(empty($currency)) continue;
                $currencyHistory = CurrencyHistory
                    ::getByDay($operationDate)
                    ->getByCurrencyId($currency->id)
                    ->first();
                if(!empty($currencyHistory)) continue;

                $currencyHistory               = new CurrencyHistory();
                $currencyHistory->currency_id  = $currency->id;
                $currencyHistory->day          = $operationDate;
                $currencyHistory->nominal      =  1;
                $currencyHistory->value        = str_replace(',','.',(string)$currencyRateRowValue);   // value: '55,9618' fo
                $currencyHistory->save();
                $newCurrencyRateAdded++;
            } // foreach ($currencyRateRows as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows

            $successMsg= "New currencies added  : " . $newCurrencyAdded . ', new currency rates added : ' . $newCurrencyRateAdded . "\n";
            echo $successMsg;

//            \Mail::to($myEmail)->send(new currencyRatesImportEmail($title .' with success ', true, $successMsg, $additiveVars));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'tag' => null], 500);
        }

    }*/



}
