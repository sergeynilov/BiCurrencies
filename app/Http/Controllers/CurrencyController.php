<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use App\Models\Currency;
use App\Library\CheckValueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Auth;
use DB;
use App\Http\Resources\CurrencyResource;


use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller  //    http://127.0.0.1:8000/current_rates
{
    public function __construct()
    {
//        $this->middleware(['currency:super-admin|admin|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function current_rates()
    {
        \Log::info(varDump(-1, ' -1 CurrencyController ::'));

        return Inertia::render('Currencies/CurrentRates', []);
    }

    public function filter()
    {
//        if ( ! MyFuncsClass::checkUserGroup([ACCESS_ROLE_ADMIN])) {
//            return response()->json(['error' => 'Unauthorized'], HTTP_RESPONSE_NOT_UNAUTHORIZED);
//        }
        /* Route::post('current_rates/filter', [FrontendCurrencyController::class, 'filter'])->name('currencies_rates.filter');
Route::get('current_rates', [FrontendCurrencyController::class, 'current_rates'])->name('current_rates');
 */
        $request                = request();
        $items_per_page = Settings::getValue('items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($items_per_page, ' -1 filter $items_per_page::'));

        $base_currency          = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        $baseCurrency = Currency
            ::getByCharCode($base_currency)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->first();

        \Log::info(  varDump($baseCurrency, ' -1 $baseCurrency::') );
        $show_only_top_currencies            = $request->show_only_top_currencies ?? false;
        $page            = $request->page ?? 1;

        $currencies = Currency
            ::getByActive(true)
            ->getById(2) // DEBUGGING
            ->getByIsTop($show_only_top_currencies)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->withCount('currencyHistories')
            ->with('latestCurrencyHistory')
            ->orderBy('ordering', 'asc')
            ->paginate($items_per_page, array('*'), 'page', $page);
//            ->map(function ($currencyItem) {
//                foreach ($currencyItem->getMedia('app_images') as $mediaImage) {
//                    \Log::info(  varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath())::') );
//                    if (File::exists($mediaImage->getPath())) {
//                        \Log::info(  varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::') );
//                        $currencyItem->media_image_url = $mediaImage->getUrl();
//                        break;
//                    }
//                }
//
//                return $currencyItem;
//            }) ;

//        \Log::info(varDump($currencies), ' -1 filter $currencies::');
        \Log::info(varDump($currencies, ' -1 filter $currencies::'));


//        return ($currencies);
        return (CurrencyResource::collection($currencies));
    } // public function filter()

    /* public function top_currencies() // show pages listing of currencies
    {
        $show_only_top_currencies = $this->requestData['show_only_top_currencies'] ?? false;
        $retArray                 = ['message' => ''];
        $currenciesCount          = Currency::getByActive(true)->count();
        $base_currency          = Settings::getValue('base_currency', CheckValueType::cvtString, '');

        $baseCurrency = Currency
            ::getByCharCode($base_currency)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->first();

        $currencies        = Currency
            ::getByActive(true)
            ->getByIsTop($show_only_top_currencies)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->withCount('currencyHistories')
            ->with('latestCurrencyHistory')
            ->orderBy('ordering', 'asc')
            ->get();

        $retArray['currencies']        = $currencies;
        $retArray['currenciesCount']       = $currenciesCount;

        return response()->json($retArray, HTTP_RESPONSE_OK);
    } // public function top_currencies($page = null)

    public function get_currency_history($currencyId)
    {
        $retArray = ['message' => ''];
        $currencyHistories     = CurrencyHistory
            ::getByCurrencyId($currencyId) // scopeGetByCurrencyId
            ->orderBy('day', 'desc')
            ->get();
        $retArray['currencyHistories']        = $currencyHistories;

        return response()->json($retArray, HTTP_RESPONSE_OK);
    } // public function get_currency_history($page = null)

}*/
}
