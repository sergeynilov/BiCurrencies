<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\CMSItem;
use App\Models\Quote;
use App\Models\User;
use App\Models\ModelHasPermission;
use App\Library\CheckValueType;

//use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Notifications\ContactUsCreatedNotification;

//use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\File;
use App\Http\Resources\UserResource;
use Inertia\Inertia;
use Auth;
use Session;
use DB;

use App\Http\Requests\ContactUsRequest;
use Spatie\Image\Image;


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
            return Inertia::render('Frontend/Home/Home');
    }

    public function get_block_quote()
    {
        $request= request();
//        \Log::info( '-1 get_block_quote $request->all()::' . print_r( $request->all(), true  ) );
        $key= 'mark_rutte_quote';
        $quotes = Quote
            ::getByKey( ( $request->keys ?? []) )
            ->getByPublished(true)
            ->get();
        if (empty($quotes)) {
            return response()->json([
                'message' => 'Quote with key "' . $key . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $image = [];
        foreach( $quotes as $next_key=>$nextQuote ) {
            foreach ($nextQuote->getMedia(config('app.media_app_name')) as $mediaImage) {
//                \Log::info(varDump($mediaImage, ' -1 $mediaImage::'));
//                \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath()::'));
                if (File::exists($mediaImage->getPath())) {
//                    $image['url']                = $mediaImage->getUrl();
                    $quotes[$next_key]->media_image_url = $mediaImage->getUrl();
                    $mediaImage->media_image_url = $mediaImage->getUrl();
//                    \Log::info(  varDump($mediaImage->getUrl(), ' -1 $mediaImage->getUrl()::') );

                    $imageInstance = Image::load($mediaImage->getUrl());
                    break;
                }
            }
        }

//        \Log::info(varDump($nextQuote, ' -10 $nextQuote::'));
        return response()->json([
            'quotes' => $quotes,
            'key'     => $key,
//            'image'   => $image
        ], HTTP_RESPONSE_OK);

    } // public function get_block_quote(string $key, $array_return= false)
    // Route::get('get_block_quote/{key}/{array_return?}', [HomeController::class, 'get_block_quote'])->name('frontend.get_block_quote');

    public function get_block_cms_item(string $key, $array_return= false)
    {
//        $key     = $request->key;
        $cMSItem = CMSItem
            ::getByKey($key)
            ->getByPublished(true)
            ->first();
        if (empty($cMSItem)) {
            return response()->json([
                'message' => 'CMS Item with key "' . $key . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $image = [];
        foreach ($cMSItem->getMedia(config('app.media_app_name')) as $mediaImage) {
//            \Log::info(varDump($mediaImage, ' -1 $mediaImage::'));
//            \Log::info(varDump($mediaImage->getPath(), ' -1 $mediaImage->getPath()::'));
            if (File::exists($mediaImage->getPath())) {
                $image['url']  = $mediaImage->getUrl();
                $imageInstance = Image::load($mediaImage->getUrl());
//                \Log::info(  varDump($imageInstance, ' -12 $imageInstance::') );
                $image['width']     = $imageInstance->getWidth();
                $image['height']    = $imageInstance->getHeight();
                $image['size']      = $mediaImage->size;
                $image['file_name'] = $mediaImage->file_name;
                break;
            }
        }

//        \Log::info(varDump($image, ' -10 $image::'));

        if($array_return) {
            return [
                'cMSItem' => $cMSItem,
                'key'     => $key,
                'image'   => $image
            ];
        }
        return response()->json([
            'cMSItem' => $cMSItem,
            'key'     => $key,
            'image'   => $image
        ], HTTP_RESPONSE_OK);
    } // public function get_block_cms_item(string $key, $array_return= false)

    public function store_contact_us(ContactUsRequest $request)
    {
        if ( ! isUserLogged()) {
            return Inertia::render('Frontend/Home/Home',
                ['message' => 'You need to login at first !'],
            );
        }

//        \Log::info(varDump($request->title, ' -1 $request->title store_contact_us::'));
        $contactUs = null;
        try {
            DB::beginTransaction();
            $contactUs = ContactUs::create([
                'title'           => $request->title,
                'author_id'       => auth()->user()->id,
                'content_message' => $request->content_message
            ]);

            $supportManagers = ModelHasPermission
                ::getByPermissionId(ACCESS_APP_SUPPORT_MANAGER)
                ->with('user')
                ->get();
//            \Log::info(  varDump($supportManagers, ' -1 $supportManagers::') );
            foreach ($supportManagers as $nextSupportManager) {
                if ($nextSupportManager->user) {
                    $nextSupportManager->user->notify(new ContactUsCreatedNotification($request->title,
                        $request->content_message, auth()->user()->id));
                }
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();

//            \Log::info('-1 $contactUs store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        \Log::info('-1 store $contactUs->id::' . print_r($contactUs->id, true));
        return Inertia::render('Frontend/Home/Home',
            ['' => $contactUs]
        );
    }


    public function get_our_authors()
    {
        $authors = CMSItem
//            ::orderBy('cms_items_count', 'desc')->orderBy('author_id', 'asc')
            ::select('author_id', DB::raw('count(*) as cms_items_count'))
            ->groupBy('author_id')
            ->orderBy('cms_items_count', 'desc')
            ->havingRaw('count(*) >= 1')
            ->get();

        foreach ($authors as $next_key=>$nextCMSItem) {
            $nextAuthor = User::find($nextCMSItem['author_id']);
            if ( ! empty($nextAuthor)) {
//                \Log::info(varDump($nextAuthor, ' -1 $nextAuthor::'));
                $has_image  = false;
                foreach ($nextAuthor->getMedia(config('app.media_app_name')) as $mediaImage) {
                    if (File::exists($mediaImage->getPath())) {
//                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                        $authors[$next_key]->author = $nextAuthor;
                        $authors[$next_key]->media_image_url = $mediaImage->getUrl();
                        $has_image                           = true;
                        break;
                    }
                }
                if ( ! $has_image) {
                    $authors[$next_key]->media_image_url = '/images/default-avatar.png';
                    $authors[$next_key]->author = $nextAuthor;
                }
            }
        }
//        \Log::info(varDump($authors, ' -1 get_our_authors $authors::'));
        return response()->json([
            'authors' => $authors
        ], HTTP_RESPONSE_OK);
    } // public function get_our_authors()

    public function our_rules()
    {
        $ourRulesBlock= $this->get_block_cms_item('our_rules_block', true);
//        \Log::info(  varDump($ourRulesBlock, ' -1 $ourRulesBlock::') );
        return Inertia::render('Frontend/CMSItem/Page', [
                'cMSItem' => $ourRulesBlock['cMSItem'],
                'image' => $ourRulesBlock['image'],
            ]
        );
    } // public function our_rules()
                   // Route::get('our_rules', [HomeController::class, 'our_rules'])->name('frontend.our_rules');


    public function get_settings_value(Request $request, $key)
    {
//        \Log::info(varDump($key, ' -1 get_settings_value $key::'));
        $value = Settings::getValue($key);
        return response()->json([
            'value' => $value,
            'key'   => $key,
        ], HTTP_RESPONSE_OK);
    } // public function get_settings_value(Request $request)

    // Route::post('load_currency_subscription_selection', [HomeController::class, 'load_currency_subscription_selection'])->name('frontend.load_currency_subscription_selection');

    public function load_currency_subscription_selection(Request $request)
    {
        $currencies = Currency
            ::getByActive(true)
            ->orderBy('ordering', 'desc')
            ->get();
//        \Log::info(varDump($currencies, ' -1 get_settings_value $currencies::'));
        return response()->json([
            'currencies' => $currencies,
        ], HTTP_RESPONSE_OK);
    } // public function get_settings_value(Request $request)

    public function get_base_currency()
    {

        $value = Settings::getValue('base_currency');
        \Log::info(  varDump($value, ' -1 $value::') );
        $baseCurrency = Currency
            ::getByActive(true)
            ->getByCharCode($value)
            ->first();
        \Log::info(  varDump($baseCurrency, ' -12 $baseCurrency::') );
        return response()->json([
            'baseCurrency' => $baseCurrency,
        ], HTTP_RESPONSE_OK);
    } // public function get_settings_value(Request $request)

    public function perform_logout()
    {
//        \Log::info(  varDump(1, ' -1 perform_logout::') );
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
