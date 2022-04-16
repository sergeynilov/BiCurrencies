<?php

namespace App\Console\Commands;

use App\Models\UserCurrencySubscription;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Currency;
use App\Library\Services\CurrencyRatesFunctionality;
use App;

class sendUserCurrencySubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *  php artisan command:sendUserCurrencySubscriptions
     * @var string
     */
    protected $signature = 'command:sendUserCurrencySubscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $currencyRatesFunctionality= App::make(CurrencyRatesFunctionality::class);
//        $ret= \App\Library\Services\CurrencyRatesFunctionality::runImportCurrencyRates();
        $ret= $currencyRatesFunctionality->runSendUserCurrencySubscriptions(true);
        \Log::info(  varDump($ret, ' -1 runSendUserCurrencySubscriptions $ret::') );



        return 0;
    }


}
