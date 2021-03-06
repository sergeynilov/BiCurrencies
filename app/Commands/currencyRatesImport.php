<?php

namespace App\Console\Commands;

use App\Library\CheckValueType;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use Illuminate\Support\Str;
use App\Mail\currencyRatesImportEmail;


class currencyRatesImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:currencyRatesImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command:currencyRatesImport description';

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
        $search_web_url = config('app.currency_rates_import_url');

        $site_name = Settings::getValue('site_name', CheckValueType::cvtString, '');
        $support_signature = 'Yours truly, ' . $site_name . ' support';

        $myEmail = 'nilovsergey@yahoo.com';
        $additiveVars = [
            'support_signature' => $support_signature,
        ];
        $ccEmail= 'nilov@softreactor.com';
        $title        = 'Currency rates import run at ' . $site_name;

        $base_currency_code       = Settings::getValue('base_currency', CheckValueType::cvtString, '');
//        \Log::info(  varDump($base_currency_code, ' -1 $base_currency_code::') );

        if( empty($base_currency_code) ) {
            echo "Main currency is not set.  Check Settings page ! \n";
            \Mail::to($myEmail)->cc([$ccEmail])->send(new currencyRatesImportEmail($title .' with errors ', false, 'Main currency is not set.  Check Settings page !', $additiveVars));
            return -1;
        }

//        \Log::info(  varDump($base_currency_code, ' -1$$base_currency_code::') );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_URL, $search_web_url . $base_currency_code);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","charset=utf-8"));
        $resp = curl_exec($ch);

        if (false === $resp) {
            $err = curl_error($ch);
            curl_close($ch);

            return response()->json([
                'message'       => 'Error on remote server : ' . $err,
            ], 500);
        }
        curl_close($ch);
                              // file:///_wwwroot/lar/backend_currencies/app/Models/CurrencyHistory.php
//        $xml = simplexml_load_string($resp, "SimpleXMLElement", LIBXML_NOCDATA);
        $currencyRateRowData = json_decode($resp)->rates;
//        \Log::info(  varDump($currencyRateRowData, ' -1 $currencyRateRowData::') );
//        $json = json_encode($xml);
        $currencyRateRows= $currencyRateRowData;
        if( gettype($currencyRateRowData) === 'string' ) {
            $currencyRateRows = json_decode($currencyRateRowData, true);
        }
        if( gettype($currencyRateRowData) === 'object' ) {
            $currencyRateRows = objectIntoArray($currencyRateRowData, true);
        }
//        \Log::info(  varDump($currencyRateRows, ' -1 $currencyRateRows::') );

//        $formattedDate = str_replace('.', ' ', $valCursArray['@attributes']['Date']) ?? null;

        $operation_date = Carbon::now(config('app.timezone'))->format('Y-m-d' );
//        \Log::info( '-1 $operation_date ::' . print_r( $operation_date, true  ) );

        if(empty($operation_date)) {
            abort(403, 'Operation Date is not set.');
        }
//        $currencyRateRows = $valCursArray['Valute'] ?? [];
        try {
            $newCurrencyAdded= 0;
            $new_currency_rate_added= 0;
            DB::beginTransaction();
            foreach ($currencyRateRows as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows
                $currency = Currency::getByCharCode($currencyRateRowCharCode)->first();
                if(empty($currency)) { // add new currency

                    $maxOrdering            = Currency::max('ordering');
                    $currency               = new Currency();
                    $currency->name         = 'currency name created ' . Carbon::now(config('app.timezone'));
                    $currency->num_code     = $this->getUnused3NumCode();
                    $currency->ordering     = $maxOrdering + 1;
                    $currency->char_code    = $currencyRateRowCharCode;
                    $currency->save();
                    $newCurrencyAdded++;
                } // if(empty($currency)) { // add new currency

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
                $new_currency_rate_added++;
            } // foreach ($currencyRateRows as $currencyRateRowCharCode => $currencyRateRowValue) { // all currency rate rows

            $successMsg= "New currencies added  : " . $newCurrencyAdded . ', new currency rates added : ' . $new_currency_rate_added . "\n";
            echo $successMsg;

            \Mail::to($myEmail)->send(new currencyRatesImportEmail($title .' with success ', true, $successMsg, $additiveVars));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'tag' => null], 500);
        }

        return 0;
    }

    private function getUnused3NumCode() {

        while( true ) {
            $numCode= strtolower(Str::random(3));
            $currency = Currency::getByNumCode($numCode)->first();
            if($currency===null) {
                return $numCode;
            }
        }
        return false;
    }
}
