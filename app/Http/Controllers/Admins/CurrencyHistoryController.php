<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyHistoryResource;
use App\Library\CheckValueType;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use Illuminate\Database\QueryException;
use DB;

class CurrencyHistoryController extends Controller
{
    public function index($currency_id, $page, $filter_date_from= '', $filter_date_till= '')
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to currency listing');
        }
//        \Log::info(varDump($currency_id, ' -1 CurrencyController $currency_id::'));
//        \Log::info(varDump($filter_date_from, ' -1 CurrencyController $filter_date_from::'));
//        \Log::info(varDump($filter_date_till, ' -1 CurrencyController $filter_date_till::'));

        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);
        $order_by        = $request->order_by ?? 'created_at';
        $order_direction = $request->order_direction ?? 'desc';

        $currencyHistories = CurrencyHistory
            ::getByCurrencyId((int)$currency_id)
            ->getByDay($filter_date_from, '>=')
            ->getByDay($filter_date_till, '<=')
            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);
        return (CurrencyHistoryResource::collection($currencyHistories));
    }

    public function destroy($currency_history_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to destroy currency history');
        }

        $currencyHistory = CurrencyHistory::find($currency_history_id);
        if ($currencyHistory == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $currency_history_id::'));
            return response()->json([
                'message' => 'Image for Currency history # "' . $currency_history_id . '" not found!',
            ], HTTP_RESPONSE_NOT_FOUND);
        }
        try {
            DB::beginTransaction();
            $currencyHistory->delete();
            DB::commit();

        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return back();
    }
}
