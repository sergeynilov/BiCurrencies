<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Settings;
use App\Library\CheckValueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Auth;
use DB;
//use App\Http\Resources\SettingsResource;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller  //    http://127.0.0.1:8000/admin/currencies
{
    public function __construct()
    {
//        $this->middleware(['currency:super-admin|admin|moderator']);
    }

    public function edit()
    {
        if ( ! auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            \Log::info('-99 update ::');
            return redirect(route('admin.dashboard.index'))->withErrors([
                'message',
                'You have no access to settings page'
            ]);
        }
        $settings = Settings
            ::select('*')
            ->get()
            ->pluck('value', 'name')
            ->toArray();

//        \Log::info(varDump($settings, ' -12 edit $settings::'));

        return Inertia::render('Admins/Settings/Edit', [
            'settingsData' => $settings,
            'currenciesSelectionArray' => Currency::getCurrenciesSelectionArray(),
        ]);

    }

    public function update(SettingsRequest $request)
    {
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->hasAnyRole(['super-admin', 'admin'])) {
            \Log::info('-99 update ::');
            return redirect(route('admin.dashboard.index'))->withErrors([
                'message',
                'You have no access to settings page'
            ]);
        }

        try {
            DB::beginTransaction();
            $requestData = $request->all();

            \Log::info(  varDump($requestData, ' -1 $requestData::') );
            foreach( $requestData as $nextSettingsKey => $nextSettingsValue ) {
                $nextSettings = Settings::getSettingsList($nextSettingsKey);

                $nextSettingsToUpdate = $nextSettings[0] ?? null;
                if( empty($nextSettingsToUpdate) ) {
                    $nextSettingsToUpdate             = new Settings;
                    $nextSettingsToUpdate->name       = $nextSettingsKey;
                } else {
                    $nextSettingsToUpdate->updated_at = Carbon::now(config('app.timezone'));
                }
                $nextSettingsToUpdate->value          = $nextSettingsValue;
                $nextSettingsToUpdate->save();
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UsersCrudController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect('/admin/dashboard')->with('flash', 'Settings  was successfully updated');
    }

    public function clear_rates_history()
    {
        try {
            DB::beginTransaction();

            CurrencyHistory::truncate();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'settings' => null], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
    }

    public function run_currency_rates_import_manually()
    {
        \Log::info( '-1 run_currency_rates_import_manually ::' . print_r( -9, true  ) );

        $exitCode = \Artisan::call('command:currencyRatesImport', []);
        return response()->json(['error_code' => 1, 'message' => "", 'exitCode' => $exitCode], HTTP_RESPONSE_OK);

    }


}
