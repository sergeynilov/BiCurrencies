<?php

namespace App\Console\Commands;

use App\Library\CheckValueType;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\CurrencyRatesImportRun;
use Exception;
use DB;

class importCurrencyRates extends Command
{ // php artisan  command:importCurrencyRates
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importCurrencyRates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $site_name = Settings::getValue('site_name', CheckValueType::cvtString, '');
        $support_signature = 'Yours truly, ' . $site_name . ' support';

        $myEmail = 'nilovsergey@yahoo.com';
        $additiveVars = [
            'support_signature' => $support_signature,
        ];
        $ccEmail= 'nilov@softreactor.com';
        $title        = 'Currency rates import run at ' . $site_name;

        $baseCurrencyCode       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
//        \Log::info(  varDump($baseCurrencyCode, ' -1 $baseCurrencyCode::') );

        if( empty($baseCurrencyCode) ) {
            echo "Main currency is not set.  Check Settings page ! \n";
//            \Mail::to($myEmail)->cc([$ccEmail])->send(new currencyRatesImportEmail($title .' with errors ', false, 'Main currency is not set.  Check Settings page !', $additiveVars));
            return -1;
        }

//        \Log::info(  varDump($baseCurrencyCode, ' -1$$baseCurrencyCode::') );

        $operationDate = Carbon::now(config('app.timezone'))->format('Y-m-d' );
//        \Log::info( '-1 $operationDate ::' . print_r( $operationDate, true  ) );
        if(empty($operationDate)) {
            abort(403, 'Operation Date is not set.');
        }


        $req_url = 'https://api.exchangerate.host/latest?base=' . $baseCurrencyCode;
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
                    var_dump($response);
                    if(!empty($response->rates)) {
                        $rates=  (array)$response->rates;
                        $this->writeRatesIntoDb($operationDate, $rates);
                    }
                }
            } catch(Exception $e) {
                abort(403, print_r($e->getMessage(), true));
            }
        }
        //     public function __construct(bool $from_cli, User $user= null)
        $user= User::find(1);
        if($user) {
            $user->notify(new CurrencyRatesImportRun(true, null));
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

    }

}
