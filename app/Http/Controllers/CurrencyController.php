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
use App\Http\Resources\CurrencyHistoryResource;


use App\Http\Requests\CurrencyRequest;
use Spatie\Image\Image;

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
    // Route::get('all_currencies', [FrontendCurrencyController::class, 'all_currencies'])->name('frontend.all_currencies');
    public function all_currencies()
    {
        \Log::info(varDump(-1, ' -1 CurrencyController all_currencies::'));

        $base_currency = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        $baseCurrency  = Currency
            ::getByCharCode($base_currency)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->first();

        \Log::info(varDump($baseCurrency, ' -1 $baseCurrency::'));
        $show_only_top_currencies = $request->show_only_top_currencies ?? false;

        \Log::info(  varDump($show_only_top_currencies, ' -1 show_only_top_currencies::') );
        $currencies = Currency
            ::getByActive(true)
//            ->getById(2) // DEBUGGING
//            ->whereIn(with(new Currency)->getTable() . '.id', [1 ,2, 3])
            ->getByIsTop($show_only_top_currencies)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->withCount('currencyHistories')
            ->with('latestCurrencyHistory')
            ->orderBy('ordering', 'asc')
            ->get();
        foreach ($currencies as $next_key => $nextCurrency) {
            $has_image= false;
            foreach ($nextCurrency->getMedia(config('app.media_app_name')) as $mediaImage) {
//                \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath())::'));
                if (File::exists($mediaImage->getPath())) {
//                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                    $currencies[$next_key]->media_image_url = $mediaImage->getUrl();
                    $currencies[$next_key]->latest_currency_history = $nextCurrency->latest_currency_history;
                    $has_image= true;
                    break;
                }
            }
            if(!$has_image) {
                $currencies[$next_key]->media_image_url = '/images/default-currency.jpg';
            }
        }
        \Log::info(varDump($currencies, ' -1 filter $currencies::'));
        return Inertia::render('Frontend/AllCurrencies', [
            'currencies' => $currencies,
            'baseCurrency' => $baseCurrency,

            ]
        );


    }

    public function filter()
    {
        $request        = request();

        $base_currency = Settings::getValue('base_currency', CheckValueType::cvtString, '');
        $baseCurrency  = Currency
            ::getByCharCode($base_currency)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->first();

//        \Log::info(varDump($baseCurrency, ' -1 $baseCurrency::'));
        $show_only_top_currencies = $request->show_only_top_currencies ?? false;

        \Log::info(  varDump($show_only_top_currencies, ' -1 show_only_top_currencies::') );
        $currencies = Currency
            ::getByActive(true)
//            ->getById(2) // DEBUGGING
//            ->whereIn(with(new Currency)->getTable() . '.id', [1 ,2, 3])
            ->getByIsTop($show_only_top_currencies)
            ->excludeCharCode($baseCurrency->char_code ?? '')
            ->withCount('currencyHistories')
            ->with('latestCurrencyHistory')
            ->orderBy('ordering', 'asc')
            ->get();
        foreach ($currencies as $next_key => $nextCurrency) {
            $has_image= false;
            foreach ($nextCurrency->getMedia(config('app.media_app_name')) as $mediaImage) {
//                \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath())::'));
                if (File::exists($mediaImage->getPath())) {
//                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                    $currencies[$next_key]->media_image_url = $mediaImage->getUrl();
                    $currencies[$next_key]->latest_currency_history = $nextCurrency->latest_currency_history;
                    $has_image= true;
                    break;
                }
            }
            if(!$has_image) {
                $currencies[$next_key]->media_image_url = '/images/default-currency.jpg';
            }
        }
//        \Log::info(varDump($currencies, ' -1 filter $currencies::'));
        return (CurrencyResource::collection($currencies));
    } // public function filter()

    // Route::get('currency_history/{id}/{page?}', [FrontendCurrencyController::class, 'get_currency_history'])->name('frontend.get_currency_history');
    public function get_currency_history($currency_id, $page)
    {
        $items_per_page = Settings::getValue('items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($items_per_page, ' -1 get_currency_history $items_per_page::'));

//        $currency        = Currency
//            ::getByActive(true)
//            ->getById($currency_id)
//            ->first();

        $currencyHistories = CurrencyHistory
            ::getByCurrencyId($currency_id)
//            ->getById(2) // DEBUGGING
//            ->withCount('currencyHistories')
            ->orderBy('id', 'asc')
            ->paginate($items_per_page, array('*'), 'page', $page);
    \Log::info(varDump($currencyHistories, ' -1 get_currency_history $currencyHistories::'));
       return (CurrencyHistoryResource::collection($currencyHistories));
//            //         return (CurrencyResource::collection($currencies));

        //        return response()->json([
//            'currency'=> new CurrencyResource($currency),
//            'currencyHistoryRows'=> CurrencyHistoryResource::collection($currencyHistories)
//        ], HTTP_RESPONSE_OK);
    } // public function get_currency_history()

    //             // Route::get('currency_details/{id}', [FrontendCurrencyController::class, 'get_currency_details'])->name('frontend.get_currency_details');
     public function get_currency_details($currency_id) // show pages listing of currencies
    {
        $currencyImage                 = [];

        $currency        = Currency
            ::getByActive(true)
            ->getById($currency_id)
            ->first();

//        \Log::info(  varDump($currency, ' -1 $currency::') );
         $has_image= false;
        foreach ($currency->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
                $currencyImage['url']       = $mediaImage->getUrl();
                $imageInstance = Image::load($mediaImage->getUrl());
                \Log::info(  varDump($imageInstance, ' -1 $imageInstance::') );
                $currencyImage['width']     = $imageInstance->getWidth();
                $currencyImage['height']    = $imageInstance->getHeight();
                $currencyImage['size']      = $mediaImage->size;
                $currencyImage['file_name'] = $mediaImage->file_name;
                $has_image= true;
            }
        }
         if(!$has_image) {
             $currencyImage['url'] = '/images/default-currency.jpg';
         }

        return response()->json([
            'currencyImage'=> $currencyImage,
            'currency'=> new CurrencyResource($currency)
        ], HTTP_RESPONSE_OK);
    } // public function top_currencies($page = null)

}
