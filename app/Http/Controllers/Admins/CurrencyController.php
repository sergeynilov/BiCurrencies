<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyHistoryResource;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use App\Models\Currency;
use App\Library\CheckValueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Auth;
use DB;
use App\Http\Resources\CurrencyResource;
use App\Http\Requests\CurrencyRequest;
use App\Http\Requests\CurrencyDescriptionRequest;
use App\Http\Requests\UploadCurrencyImageRequest;
use Spatie\Image\Image;

class CurrencyController extends Controller  //    http://127.0.0.1:8000/admin/currencies
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
    public function index()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        \Log::info(varDump(-1, ' -1 CurrencyController ::'));

        return Inertia::render('Admins/Currencies/Index', []);
    }

    public function filter()
    {
        \Log::info(  varDump(-9, ' -9 filter::') );
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            \Log::info(  varDump(-98, ' -98 INSIDE  filter::') );
            return (CurrencyResource::collection([]));
        }

        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);

        $page            = $request->page ?? 1;
        $filter_name     = $request->filter_name ?? '';
        $order_by        = $request->order_by ?? 'ordering';
        $order_direction = $request->order_direction ?? 'desc';

        $currencies = Currency
            ::getByName($filter_name)
//            ->whereRaw(with(new Currency)->getTable().'.id  >= 30 ') // DEBUGGING

            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);

//        \Log::info(varDump(CurrencyResource::collection($currencies), ' -1 filter $currencies::'));

        return (CurrencyResource::collection($currencies));
    } // public function filter()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        return Inertia::render('Admins/Currencies/Create', [
            'currency' => new Currency,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        $currency = null;
        try {
            DB::beginTransaction();
            $currency = Currency::create([
                'name'      => $request->name,
                'num_code'  => $request->num_code,
                'char_code' => $request->char_code,
                'bgcolor'   => $request->bgcolor,
                'color'     => $request->color,
                'is_top'    => $request->is_top ? true : false,
                'active'    => $request->active ? true : false,
                'ordering'  => $request->ordering ?? Currency::max('ordering') + 1,
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 CurrencyController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }
        \Log::info('-1 store $currency->id::' . print_r($currency->id, true));

        return redirect(route('admin.currencies.edit', $currency->id))
            ->with('flash','New currency was successfully added')
            ->with('flash_type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Currency $currency
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $currency_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to currency edit method')
                ->with('flash_type', 'error');
        }

//        \Log::info(varDump($currency_id, ' -1 edit $currency_id::'));
        $currency = Currency
            ::getById($currency_id)
            ->first();
        if ($currency == null) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'Currency was not found')
                ->with('flash_type', 'error');
        }

        $minCurrencyHistoryDay = CurrencyHistory
            ::getByCurrencyId($currency_id)
            ->min('day');
        \Log::info(  varDump($minCurrencyHistoryDay, ' -1 $minCurrencyHistoryDay::') );
//        \Log::info(varDump($currency, ' -12 edit $currency::'));

        $currencyImage = [];
        foreach ($currency->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
                $currencyImage['url']       = $mediaImage->getUrl();
                $imageInstance = Image::load($mediaImage->getUrl());
                $currencyImage['width']     = $imageInstance->getWidth();
                $currencyImage['height']    = $imageInstance->getHeight();
                $currencyImage['size']      = $mediaImage->size;
                $currencyImage['file_name'] = $mediaImage->file_name;
                break;
            }
        }

        \Log::info(  varDump($currencyImage, ' -1 currencyImage::') );
        return Inertia::render('Admins/Currencies/Edit', [
            'currency' => $currency,
            'currencyImage' => $currencyImage,
            'minCurrencyHistoryDay' => $minCurrencyHistoryDay,
        ]);
    }

    public function update(CurrencyRequest $request, int $currency_id)
    {
//        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();

        try {
            DB::beginTransaction();

            $currency->name       = $request->name;
            $currency->num_code   = $request->num_code;
            $currency->char_code  = $request->char_code;
            $currency->bgcolor    = $request->bgcolor;
            $currency->color      = $request->color;
            $currency->is_top     = $request->is_top ? true : false;
            $currency->active     = $request->active ? true : false;
            $currency->ordering   = $request->ordering ?? Currency::max('ordering') + 1;
            $currency->updated_at = Carbon::now(config('app.timezone'));
            $currency->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 CurrencyController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect(route('admin.currencies.index'))
            ->with('flash', 'Currency was successfully updated')
            ->with('flash_type', 'success');
    } // public function update(CurrencyRequest $request, int $currency_id)

    public function destroy(int $currency_id)
    {
        \Log::info(  varDump(-1, ' -1 destroy::') );
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            \Log::info(  varDump(-199, ' -199 destroy::') );
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        $currency = Currency::find($currency_id);
        if ($currency == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $currency_id::'));

            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
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

        return redirect(route('admin.currencies.index'))
            ->with('flash', 'You have deleted currency successfully')
            ->with('flash_type', 'success');
    }


    public function upload_image( UploadCurrencyImageRequest $request)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies listing page')
                ->with('flash_type', 'error');
        }

        \Log::info('-1 getQuestionList $request->all()::' . print_r($request->all(), true));

        $currency = Currency::find($request->currency_id);
        if ($currency === null) {
            return response()->json([
                'message'  => 'Currency # "' . $request->currency_id . '" not found',
                'currency' => null
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $currencyImageUploadedFile = $request->file('image');
        \Log::info(varDump($currencyImageUploadedFile->getPathName(),
            ' -1 $currencyImageUploadedFile->getPathName()::'));

        $image_filename     = checkValidFilename($request->image_filename, 255, true);

        try {
            DB::beginTransaction();

            if ( ! empty($currencyImageUploadedFile)) {
                foreach ($currency->getMedia(config('app.media_app_name')) as $mediaImage) {
                    $mediaImage->delete();
                }

                $currency
                    ->addMediaFromRequest('image')
                    ->usingFileName($image_filename)
                    ->toMediaCollection(config('app.media_app_name') );

                $currency->updated_at = Carbon::now(config('app.timezone'));
                $currency->save();
            } // if ( ! empty($currencyImageUploadedFile)) {

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return Inertia::render('Admins/Currencies/Edit', [
            'currency' => $currency,
        ]);
    } // public function upload_image(CreateCustomerRequest $request)

    public function activate(Request $request, int $currency_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies activate method')
                ->with('flash_type', 'error');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();
        if(empty($currency)) {
            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $currency->active     = 1;
            $currency->updated_at = Carbon::now(config('app.timezone'));
            $currency->save();
//            \Log::info('-1 ACTIVATED $currency_id::' . print_r($currency_id, true));

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 CurrencyController store $e->getMessage() ::' . print_r($e->getMessage(), true));
            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'currency' => $currency,
            'message' => 'Currency was successfully activated',
        ], HTTP_RESPONSE_OK);
    } // public function activate(Request $request, int $currency_id)

    public function deactivate(Request $request, int $currency_id)
    {
        \Log::info('-1 deactivate $currency_id::' . print_r($currency_id, true));

        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currencies deactivate method')
                ->with('flash_type', 'error');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();
        if(empty($currency)) {
            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $currency->active     = 0;
            $currency->updated_at = Carbon::now(config('app.timezone'));
            $currency->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'currency' => $currency,
            'message' => 'Currency was successfully deactivated',
        ], HTTP_RESPONSE_OK);
    } // public function deactivate(Request $request, int $currency_id)

    public function description_save(CurrencyDescriptionRequest $request, int $currency_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to currency description_save method')
                ->with('flash_type', 'error');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();

        try {
            DB::beginTransaction();

            $currency->description       = $request->description;
            $currency->updated_at = Carbon::now(config('app.timezone'));
            $currency->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
        return redirect(route('admin.currencies.edit', $currency->id))
            ->with('flash', 'New description was successfully updated')
            ->with('flash_type', 'success');
    } // public function description_save(CurrencyRequest $request, int $currency_id)

}
