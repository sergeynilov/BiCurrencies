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
//        \Log::info(  varDump(auth()->user()->permissions, ' -1 $authUser->permissions::') );
//        \Log::info(  varDump(ACCESS_APP_ADMIN , ' -1 CurrencyControllerACCESS_APP_ADMIN ::') );
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }
        \Log::info(varDump(-1, ' -1 CurrencyController ::'));

        return Inertia::render('Admins/Currencies/Index', []);
    }

    public function filter()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }
        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($backend_items_per_page, ' -1 filter $backend_items_per_page::'));

        $page            = $request->page ?? 1;
        $filter_name     = $request->filter_name ?? '';
        $order_by        = $request->order_by ?? 'ordering';
        $order_direction = $request->order_direction ?? 'desc';

        $currencies = Currency
            ::getByName($filter_name)
//            ->whereRaw(with(new Currency)->getTable().'.id  >= 30 ') // DEBUGGING

            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);

        \Log::info(varDump(CurrencyResource::collection($currencies), ' -1 filter $currencies::'));

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
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
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
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
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

        return redirect(route('admin.currencies.edit', $currency->id))->with('flash',
            'warning_flash_type_New currency was successfully added');

        /* route('admin.currencies.index') */
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
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }

        \Log::info(varDump($currency_id, ' -1 edit $currency_id::'));
        $currency = Currency
            ::getById($currency_id)
            ->first();

        $minCurrencyHistoryDay = CurrencyHistory
            ::getByCurrencyId($currency_id)
            ->min('day');
        \Log::info(  varDump($minCurrencyHistoryDay, ' -1 $minCurrencyHistoryDay::') );

        if (empty($currency)) {
            return redirect(route('admin.currencies.index'));
        }
        \Log::info(varDump($currency, ' -12 edit $currency::'));

        return Inertia::render('Admins/Currencies/Edit', [
            'currency' => $currency,
            'minCurrencyHistoryDay' => $minCurrencyHistoryDay,
        ]);


/*
        public function project(project $project){
        return Inertia::render('Projects/ProjectPage', [
            'project' => [
                'id' => $project->id,
                'projectImage' => $project->projectImage,
                'projectText' => $project->projectText,
            ]
        ]);
    }*/
    }

    public function update(CurrencyRequest $request, int $currency_id)
    {
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
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

        return redirect(route('admin.dashboard.index'))->with('flash', 'Currency was successfully updated');
    } // public function update(CurrencyRequest $request, int $currency_id)

    public function destroy(int $currency_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to destroy currency');
        }

        $currency = Currency::find($currency_id);
        if ($currency == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $currency_id::'));

//            return redirect('/admin/currencies')->with('flash', 'warning_flash_type_Currency was not found !');
            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found!',
                'image'   => null
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
            ->with('flash', 'success_flash_type_You have deleted currency successfully !');
    }

    public function get_currency_image($currency_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }
//        \Log::info(varDump($currency_id, ' -1 get_currency_image $currency_id::'));
        $currency = Currency::find($currency_id);
        if ($currency == null) {
            return redirect(route('admin.dashboard.index'))->with('flash', 'warning_flash_type_Currency was not found !');
        }

        $retArray = [];
        foreach ($currency->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
                $retArray['url']       = $mediaImage->getUrl();
                $imageInstance = Image::load($mediaImage->getUrl());
                $retArray['width']     = $imageInstance->getWidth();
                $retArray['height']    = $imageInstance->getHeight();
                $retArray['size']      = $mediaImage->size;
                $retArray['file_name'] = $mediaImage->file_name;
                return response()->json([
                    'image' => $retArray,
                    HTTP_RESPONSE_OK
                ]);
            }
        }
        return response()->json([
            'message' => 'Image for Currency # "' . $currency_id . '" not found!',
            'image'   => null
        ], HTTP_RESPONSE_NOT_FOUND);
    }  //

    public function upload_image( /*UploadCurrencyImageRequest */ Request $request)
    {
        \Log::info('-1 getQuestionList $request->all()::' . print_r($request->all(), true));

        $currency = Currency::find($request->id);
        if ($currency === null) {
            return response()->json([
                'message'  => 'Currency # "' . $request->id . '" not found!',
                'currency' => null
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $currencyImageUploadedFile = $request->file('image');
        \Log::info(varDump($currencyImageUploadedFile->getPathName(),
            ' -1 $currencyImageUploadedFile->getPathName()::'));


        /*        $uploaded_file_max_mib = (float)\Config::get('app.uploaded_file_max_mib', 1);
                $max_size              = 1024 * $uploaded_file_max_mib;
                $rules                 = array(
                    'image' => 'max:' . $max_size,
                );
                $validator             = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json([
                        'message'                 => 'Size of uploaded file is bigger permitted ' . getNiceFileSize(( 1024 * $max_size) ),
                    ], HTTP_RESPONSE_BAD_REQUEST);
                }*/

//        $imagesExtensions   = config('app.images_extensions');

        /*        $currency_image     = MyFuncsClass::checkValidImgName
                ( $requestData['image_filename'], with(new Currency)->getImageFilenameMaxLength(), true );

                $filename_extension = MyFuncsClass::getFilenameExtension($currency_image);
                if ( !in_array($filename_extension, $imagesExtensions) ) {
                    return response()->json([
                        'message'                 => 'Extension ' . $filename_extension . ' is not permitted !',
                    ], HTTP_RESPONSE_BAD_REQUEST);
                }*/

        try {
            DB::beginTransaction();

            if ( ! empty($currencyImageUploadedFile)) {
                foreach ($currency->getMedia(config('app.media_app_name')) as $mediaImage) {
                    $mediaImage->delete();
                }

                $currency
                    ->addMediaFromRequest('image')
                    ->usingFileName($request->image_filename)
                    ->toMediaCollection(config('app.media_app_name') );

                $currency->updated_at = Carbon::now(config('app.timezone'));
                $currency->save();
            } // if ( ! empty($currencyImageUploadedFile)) {

//            if ( ! empty($category_image)) {
//                $dest_image = 'public/' . Currency::getCurrencyImagePath($category->id, $category_image);
//                Storage::disk('local')->put($dest_image, File::get($category_file_path));
//                ImageOptimizer::optimize( storage_path().'/app/'.$dest_image, null );
//            } // if ( !empty($category_image) ) {

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'category' => (new CurrencyResource($currency)),
            HTTP_RESPONSE_OK
        ]);
    } // public function upload_image(CreateCustomerRequest $request)

    public function activate(Request $request, int $currency_id)
    {
//        \Log::info('-1 activate $currency_id::' . print_r($currency_id, true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();
        if(empty($currency)) {
            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found!',
                'image'   => null
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
            ], HTTP_RESPONSE_NOT_FOUND);
        }
        return response()->json([
            'currency' => $currency,
            'message' => 'warning_flash_type_Currency was successfully activated987 !',
            HTTP_RESPONSE_OK
        ]);
    } // public function activate(Request $request, int $currency_id)

    public function deactivate(Request $request, int $currency_id)
    {
//        \Log::info('-1 deactivate $currency_id::' . print_r($currency_id, true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'warning_flash_type_You have no access to currency listing');
        }

        $currency = Currency
            ::getById($currency_id)
            ->first();
        if(empty($currency)) {
            return response()->json([
                'message' => 'Currency # "' . $currency_id . '" not found!',
                'image'   => null
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
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        return response()->json([
            'currency' => $currency,
            'message' => 'warning_flash_type_Currency was successfully deactivated764 !',
            HTTP_RESPONSE_OK
        ]);
    } // public function deactivate(Request $request, int $currency_id)

}
