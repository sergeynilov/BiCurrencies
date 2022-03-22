<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\Services\CurrencyRatesFunctionality;
use App;

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
        $currencyRatesFunctionality= App::make(CurrencyRatesFunctionality::class);
//        $ret= \App\Library\Services\CurrencyRatesFunctionality::runImportCurrencyRates();
        $ret= $currencyRatesFunctionality->runImportCurrencyRates();
        \Log::info(  varDump($ret, ' -1 importCurrencyRates $ret::') );
        return 0;
    }


}
