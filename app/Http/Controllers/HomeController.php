<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Settings;
use App\Models\CMSItem;
use App\Models\ModelHasPermission;
use App\Library\CheckValueType;

//use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

//use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Auth;
use DB;

use App\Http\Requests\ContactUsRequest;
use Spatie\Image\Image;
use App\Notifications\ContactUsCreatedNotification;


class HomeController extends Controller  //    http://127.0.0.1:8000/current_rates
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rate_decimal_numbers = Settings::getValue('rate_decimal_numbers', CheckValueType::cvtInteger, 2);
        \Log::info(varDump($rate_decimal_numbers, ' -1 $rate_decimal_numbers::'));

        return Inertia::render('Home/Home',
            ['rate_decimal_numbers' => $rate_decimal_numbers]
        );
    }

    // Route::post('/get_block_cms_item', [HomeController::class, 'frontend.get_block_cms_item']);
    public function get_block_cms_item(Request $request)
    {
        $key     = $request->key;
        $cMSItem = CMSItem
            ::getByKey($key)
            ->first();
        if (empty($cMSItem)) {
            return response()->json([
                'message' => 'CMS Item with key "' . $key . '" not found !',
                HTTP_RESPONSE_BAD_REQUEST
            ]);
        }

        $image = [];
        foreach ($cMSItem->getMedia(config('app.media_app_name')) as $mediaImage) {
            \Log::info(varDump($mediaImage, ' -1 $mediaImage::'));
            \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath()::'));
            if (File::exists($mediaImage->getPath())) {
                \Log::info(varDump($mediaImage, ' -10 FOUBND ::'));
                \Log::info(varDump($mediaImage->getUrl(), ' -11 $mediaImage->getUrl() ::'));
                $image['url']       = $mediaImage->getUrl();
                $imageInstance      = Image::load($mediaImage->getUrl());
                \Log::info(  varDump($imageInstance, ' -12 $imageInstance::') );
                $image['width']     = $imageInstance->getWidth();
                $image['height']    = $imageInstance->getHeight();
                $image['size']      = $mediaImage->size;
                $image['file_name'] = $mediaImage->file_name;
                break;
            }
        }


        \Log::info(varDump($image, ' -10 $image::'));

        return response()->json([
            'cMSItem' => $cMSItem,
            'key'     => $key,
            'image'   => $image
        ], HTTP_RESPONSE_OK);
    } // public function get_block_cms_item(Request $request)

    //         Route::post('', [HomeController::class, 'store_contact_us'])->name('frontend.store_contact_us');

    public function store_contact_us(ContactUsRequest $request)
    {
        if ( ! isUserLogged()) {
            return response()->json([
                'message' => 'You need to login at first !',
            ], HTTP_RESPONSE_UNAUTHORIZED);
        }

//        \Log::info(varDump($request->title, ' -1 $request->title store_contact_us::'));
        $contactUs = null;
        try {
            DB::beginTransaction();
            $contactUs = ContactUs::create([
                'title'     => $request->title,
                'author_id' => auth()->user()->id,
                'content_message'   => $request->content_message
            ]);

            $supportManagers= ModelHasPermission
                ::getByPermissionId(ACCESS_APP_SUPPORT_MANAGER)
                ->with('user')
                 ->get();
//            \Log::info(  varDump($supportManagers, ' -1 $supportManagers::') );
            foreach( $supportManagers as $nextSupportManager ) {
                if($nextSupportManager->user) {
                    $nextSupportManager->user->notify(new ContactUsCreatedNotification($request->title, $request->content_message, auth()->user()->id));
                }
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 $contactUs store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }
//        \Log::info('-1 store $contactUs->id::' . print_r($contactUs->id, true));


        return Inertia::render('Home/Home',
            [ ''=> $contactUs]
        );
    }

}
