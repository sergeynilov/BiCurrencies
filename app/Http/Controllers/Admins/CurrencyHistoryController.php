<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyHistoryResource;
use App\Library\CheckValueType;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CurrencyHistoryController extends Controller
{
    public function index($currency_id, $page, $filter_date_from= '', $filter_date_till= '')
    { //             let url = route('admin.currency_histories.index', [currency.value.id, currencies_history_current_page.value, currency_history_filter_date_from.value, currency_history_filter_date_till.value])

        if ( ! auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to currency listing');
        }
        \Log::info(varDump($currency_id, ' -1 CurrencyController $currency_id::'));
        \Log::info(varDump($filter_date_from, ' -1 CurrencyController $filter_date_from::'));
        \Log::info(varDump($filter_date_till, ' -1 CurrencyController $filter_date_till::'));

        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);
        $order_by        = $request->order_by ?? 'created_at';
        $order_direction = $request->order_direction ?? 'desc';

//        ->getByActivatedAt($this->filters['activated_at_date_from'], '>')
//        ->getByActivatedAt($this->filters['activated_at_date_till'], '<=')

        $currencyHistories = CurrencyHistory
            ::getByCurrencyId((int)$currency_id)
            ->getByDay($filter_date_from, '>')
            ->getByDay($filter_date_till, '<=')
            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);
//        \Log::info(varDump(CurrencyHistoryResource::collection($currencyHistories), ' -1 filter $currencyHistories::'));

        return (CurrencyHistoryResource::collection($currencyHistories));
    }

    public function destroy($currency_id)
    {
        if ( ! auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to destroy currency history');
        }

        $currency = Currency::find($currency_id+1000);
        if ($currency == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $currency_id::'));
            return redirect('/admin/currencies')->with('flash', 'Currency was not found !');
        }
        try {
            DB::beginTransaction();
            $currency->delete();
            DB::commit();

        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 CurrencyController destroy $e->getMessage() ::' . print_r($e->getMessage(), true));
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }
}
