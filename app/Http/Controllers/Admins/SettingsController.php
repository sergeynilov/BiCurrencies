<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadSettingsImageRequest;
use App\Library\Services\CurrencyRatesFunctionality;
use App\Models\Currency;
use App\Models\Settings;
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
use App;
use Exception;

//use App\Http\Resources\SettingsResource;
use App\Http\Requests\SettingsRequest;
use Spatie\Image\Image;

class SettingsController extends Controller  //    http://127.0.0.1:8000/admin/currencies
{
    public function __construct()
    {
//        $this->middleware(['currency:super-admin|admin|moderator']);
    }

    public function edit()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to settings page')
                ->with('flash_type', 'error');
        }
        $settings = Settings
            ::select('*')
            ->get()
            ->pluck('value', 'name')
            ->toArray();

        $smallIcon= null;
        \Log::info(varDump($settings, ' -12 edit $settings::'));

        $settingsSmallIcon = [];
//        $smallIconSettings= null;
        $settings = Settings::getSettingsList('small_icon');

        if(!empty($settings[0])) {
            foreach ($settings[0]->getMedia(config('app.media_app_name')) as $mediaImage) {
                if (File::exists($mediaImage->getPath())) {
                    $settingsSmallIcon['url']       = $mediaImage->getUrl();
                    $imageInstance                  = Image::load($mediaImage->getUrl());
                    $settingsSmallIcon['width']     = $imageInstance->getWidth();
                    $settingsSmallIcon['height']    = $imageInstance->getHeight();
                    $settingsSmallIcon['size']      = $mediaImage->size;
                    $settingsSmallIcon['file_name'] = $mediaImage->file_name;
                    break;
                }
            }
        }

        return Inertia::render('Admins/Settings/Edit', [
            'settingsData' => $settings,
            'currenciesSelectionArray' => Currency::getCurrenciesSelectionArray(),
            'settingsSmallIcon' => $settingsSmallIcon,
        ]);

    }

    public function update(SettingsRequest $request)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to update settings page')
                ->with('flash_type', 'error');
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
                    $nextSettingsToUpdate->updated_YYYat = Carbon::now(config('app.timezone'));
                }
                $nextSettingsToUpdate->value          = $nextSettingsValue;
                $nextSettingsToUpdate->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            \Log::info('-1 UsersCrudController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect(route('admin.settings.index') )->with('flash', 'Settings  was successfully updated');
    }

    public function clear_rates_history()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to clear rates history in settings page')
                ->with('flash_type', 'error');
        }

        try {
            DB::beginTransaction();

            CurrencyHistory::truncate();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'settings' => null], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
    }

    public function run_currency_rates_import()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to run currency rates import in settings page')
                ->with('flash_type', 'error');
        }

        \Log::info( '-1 run_currency_rates_import ::' . print_r( -9, true  ) );
        $currencyRatesFunctionality= App::make(CurrencyRatesFunctionality::class);
//        $ret= \App\Library\Services\CurrencyRatesFunctionality::runImportCurrencyRates();
        $retArray= $currencyRatesFunctionality->runImportCurrencyRates( from_cli: false,user_id : auth()->user()->id);
        \Log::info(  varDump($retArray, ' -1 SettingsController importCurrencyRates $retArray::') );
        return response()->json([ 'retArray' => $retArray], HTTP_RESPONSE_OK);

    }


    // LOGS BLOCK END
    public function view_laravel_log()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to view laravel log in settings page')
                ->with('flash_type', 'error');
        }

        $laravel_log= base_path('storage/logs/laravel.log');
        if ( file_exists($laravel_log) ) {
            $laravel_log_content= File::get($laravel_log);
            $laravel_log_content= preg_replace('/\r\n?/', "<br>", $laravel_log_content);
            return response()->json(['error_code' => 0, 'message' => '', 'text' => $laravel_log_content], HTTP_RESPONSE_OK);
        } else {
            return response()->json(['error_code' => 0, 'message' => 'laravel log file not found', 'text' => ''], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
    } // public function view_laravel_log

    public function delete_laravel_log()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to delete laravel log in settings page')
                ->with('flash_type', 'error');
        }

        $laravel_log= base_path('storage/logs/laravel.log');
        if ( file_exists($laravel_log) ) {
            unlink($laravel_log);
            return response()->json(['error_code' => 0, 'message' => '', 'text' => $laravel_log], HTTP_RESPONSE_OK);
        } else {
            return response()->json(['error_code' => 0, 'message' => 'laravel log file not found', 'text' => ''], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['error_code' => 0, 'message' => '', 'text' => $laravel_log], HTTP_RESPONSE_OK);
    } // public function delete_laravel_log


    public function view_sql_tracing_log()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to view sql tracing log in settings page')
                ->with('flash_type', 'error');
        }

        $sql_tracing_log= base_path('storage/logs/sql-tracing-.txt');
        if ( file_exists($sql_tracing_log) ) {
            $sql_tracing_log_content = str_replace('Time ', '<strong>Time </strong>', File::get($sql_tracing_log) );
            $sql_tracing_log_content= preg_replace('/\r\n?/', "<br>", $sql_tracing_log_content);
            return response()->json(['error_code' => 0, 'message' => '', 'text' => $sql_tracing_log_content], HTTP_RESPONSE_OK);
        } else {
            return response()->json(['error_code' => 0, 'message' => 'Sql tracing log file not found', 'text' => $sql_tracing_log],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
    } // public function view_sql_tracing_log

    public function delete_sql_tracing_log()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to delete sql tracing log in settings page')
                ->with('flash_type', 'error');
        }

        $sql_tracing_log= base_path('storage/logs/sql-tracing-.txt');
        if ( file_exists($sql_tracing_log) ) {
            unlink($sql_tracing_log);
            return response()->json(['error_code' => 0, 'message' => '', 'text' => $sql_tracing_log], HTTP_RESPONSE_OK);
        } else {
            return response()->json(['error_code' => 0, 'message' => 'Sql tracing log file not found', 'text' => $sql_tracing_log],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
    } // public function delete_sql_tracing_log

    // LOGS BLOCK END


    public function upload_image( UploadSettingsImageRequest $request)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to upload image in settings page')
                ->with('flash_type', 'error');
        }


        \Log::info('-1 getQuestionList $request->all()::' . print_r($request->all(), true));

        //         //                     fetchSettingsAppImageSmallIcon(params.uploadedImageFile, 'small_icon')
        $settingsImageUploadedFile = $request->file('image');
        \Log::info(varDump($settingsImageUploadedFile->getPathName(),
            ' -1 $settingsImageUploadedFile->getPathName()::'));

        $image_filename     = checkValidFilename($request->image_filename, 255, true);
        \Log::info(  varDump($image_filename, ' -1 $image_filename::') );
        $smallIconSettings = Settings::getSettingsList('small_icon');

        if( empty($smallIconSettings[0]) ) {
            $smallIconSettings[0]             = new Settings;
            $smallIconSettings[0]->name       = 'small_icon';
        } else {
            $smallIconSettings[0]->updated_at = Carbon::now(config('app.timezone'));
        }
        $smallIconSettings[0]->value          = $image_filename;
        $smallIconSettings[0]->save();


        try {
            DB::beginTransaction();

            if ( ! empty($settingsImageUploadedFile)) {
                foreach ($smallIconSettings[0]->getMedia(config('app.media_app_name')) as $mediaImage) {
                    $mediaImage->delete();
                }

                $smallIconSettings[0]
                    ->addMediaFromRequest('image')
                    ->usingFileName($image_filename)
                    ->toMediaCollection(config('app.media_app_name') );

//                $smallIconSettings[0]->updated_at = Carbon::now(config('app.timezone'));
//                $smallIconSettings[0]->save();
            } // if ( ! empty($settingsImageUploadedFile)) {

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
        return Inertia::render('Admins/Settings/Edit', [
            'smallIconSettings' => $smallIconSettings[0],
        ]);
    } // public function upload_image(CreateCustomerRequest $request)

}
