<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\CMSItem;
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
use App\Http\Resources\CMSItemResource;
use App\Http\Requests\CMSItemRequest;
use App\Http\Requests\CMSItemTextRequest;
use App\Http\Requests\UploadCMSItemImageRequest;
use Spatie\Image\Image;

class ContactUsController extends Controller  //    http://127.0.0.1:8000/admin/ContactUs
{
    public function __construct()
    {
//        $this->middleware(['CMSItem:super-admin|admin|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to Contact us listing method')
                ->with('flash_type', 'error');
        }
        \Log::info(varDump(-1, ' -1 ContactUsController ::'));

        return Inertia::render('Admins/ContactUs/Index', []);
    }

    public function filter()
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS item filter method')
                ->with('flash_type', 'error');
        }
        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);

        $page            = $request->page ?? 1;
        $filter_title     = $request->filter_title ?? '';
        $order_by        = $request->order_by ?? 'key';
        $order_direction = $request->order_direction ?? 'desc';

        $ContactUs = CMSItem
            ::getByTitle($filter_title)
            ->with('author')
//            ->whereRaw(with(new CMSItem)->getTable().'.id  = 3 ') // DEBUGGING
            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);
//        \Log::info(varDump(CMSItemResource::collection($ContactUs), ' -1 filter $ContactUs::'));

        return (CMSItemResource::collection($ContactUs));
    } // public function filter()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS item create method')
                ->with('flash_type', 'error');
        }

        return Inertia::render('Admins/ContactUs/Create', [
            'CMSItem' => new CMSItem,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CMSItemRequest $request)
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS item store method')
                ->with('flash_type', 'error');
        }

        $CMSItem = null;
        try {
            DB::beginTransaction();
            $CMSItem = CMSItem::create([
                'title'      => $request->title,
                'key'  => $request->key,
                'text' => $request->text ?? '',
                'author_id' => auth()->user()->id,
                'published'    => $request->published ? true : false,
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 ContactUsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }
        \Log::info('-1 store $CMSItem->id::' . print_r($CMSItem->id, true));

        return redirect(route('admin.cms_items.edit', $CMSItem->id))
            ->with('flash', 'New CMS item was successfully added')
            ->with('flash_type', 'success');
        /* route('admin.cms_items.index') */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CMSItem $CMSItem
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $cms_item_id)
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS item edit method')
                ->with('flash_type', 'error');
        }

//        \Log::info(varDump($cms_item_id, ' -1 edit $cms_item_id::'));
        $CMSItem = CMSItem
            ::getById($cms_item_id)
            ->with('author')
            ->first();
        if (empty($CMSItem)) {
            return redirect(route('admin.cms_items.index'))
                ->with('flash', 'CMS item was not found')
                ->with('flash_type', 'error');
        }


        $CMSItemImage = [];
        foreach ($CMSItem->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
                $CMSItemImage['url']       = $mediaImage->getUrl();
                $imageInstance = Image::load($mediaImage->getUrl());
                $CMSItemImage['width']     = $imageInstance->getWidth();
                $CMSItemImage['height']    = $imageInstance->getHeight();
                $CMSItemImage['size']      = $mediaImage->size;
                $CMSItemImage['file_title'] = $mediaImage->file_title;
                break;
            }
        }

        \Log::info(  varDump((new CMSItemResource($CMSItem, $CMSItemImage)), ' -11 EDIRT::') );
        return Inertia::render('Admins/ContactUs/Edit', [
//            'CMSItem' => $CMSItem,
'CMSItem' => new CMSItemResource($CMSItem),
'CMSItemImage' => $CMSItemImage,
        ]);
    }

    public function update(CMSItemRequest $request, int $cms_item_id)
    {
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS item update method')
                ->with('flash_type', 'error');
        }

        $CMSItem = CMSItem
            ::getById($cms_item_id)
            ->first();
        \Log::info('-1 update $CMSItem::' . print_r($CMSItem, true));

        try {
            DB::beginTransaction();

            $CMSItem->title       = $request->title;
            $CMSItem->key   = $request->key;
            $CMSItem->updated_at = Carbon::now(config('app.timezone'));
            $CMSItem->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 ContactUsController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect(route('admin.cms_items.index'))
            ->with('flash', 'CMS item was successfully updated')
            ->with('flash_type', 'success');
    } // public function update(CMSItemRequest $request, int $cms_item_id)

    public function destroy(int $cms_item_id)
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to destroy CMS item destroy method')
                ->with('flash_type', 'error');
        }

        $CMSItem = CMSItem::find($cms_item_id);
        if ($CMSItem == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $cms_item_id::'));

            return response()->json([
                'message' => 'CMSItem # "' . $cms_item_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }
        try {
            DB::beginTransaction();
            $CMSItem->delete();
            DB::commit();

        } catch (QueryException $e) {
            DB::rollBack();

//            \Log::info('-1 ContactUsController destroy $e->getMessage() ::' . print_r($e->getMessage(), true));
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect(route('admin.cms_items.index'))
            ->with('flash', 'You have deleted CMSItem successfully')
            ->with('flash_type', 'success');
    }

    public function upload_image( UploadCMSItemImageRequest $request)
    {
        if ( !auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL) ) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to run CMS item upload_image method')
                ->with('flash_type', 'error');
        }

        \Log::info('-1 getQuestionList $request->all()::' . print_r($request->all(), true));

        $CMSItem = CMSItem::find($request->cms_item_id);
        if ($CMSItem === null) {
            return response()->json([
                'message'  => 'CMSItem # "' . $request->cms_item_id . '" not found',
                'CMSItem' => null
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $CMSItemImageUploadedFile = $request->file('image');
        \Log::info(varDump($CMSItemImageUploadedFile->getPathName(),
            ' -1 $CMSItemImageUploadedFile->getPathName()::'));

        $image_filename     = checkValidFilename($request->image_filename, 255, true);

        try {
            DB::beginTransaction();

            if ( ! empty($CMSItemImageUploadedFile)) {
                foreach ($CMSItem->getMedia(config('app.media_app_name')) as $mediaImage) {
                    $mediaImage->delete();
                }

                $CMSItem
                    ->addMediaFromRequest('image')
                    ->usingFileName($image_filename)
                    ->toMediaCollection(config('app.media_app_name') );

                $CMSItem->updated_at = Carbon::now(config('app.timezone'));
                $CMSItem->save();
            } // if ( ! empty($CMSItemImageUploadedFile)) {

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
        return Inertia::render('Admins/ContactUs/Edit', [
            'CMSItem' => $CMSItem,
        ]);
    } // public function upload_image(CreateCustomerRequest $request)

    public function text_save(CMSItemTextRequest $request, int $cms_item_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with('flash', 'You have no access to CMS Item text_save method')
                ->with('flash_type', 'error');
        }

        $cMSItem = CMSItem
            ::getById($cms_item_id)
            ->first();

        try {
            DB::beginTransaction();

            $cMSItem->text       = $request->text;
            $cMSItem->updated_at = Carbon::now(config('app.timezone'));
            $cMSItem->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
        return redirect(route('admin.cms_items.edit', $cMSItem->id))
            ->with('flash', 'New text was successfully updated')
            ->with('flash_type', 'success');
    } // public function text_save(CMSItemRequest $request, int $cms_item_id)

    public function publish(Request $request, int $cms_item_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to CMS item publish method')
                ->with('flash_type', 'error');
        }

        $CMSItem = CMSItem
            ::getById($cms_item_id)
            ->first();
        \Log::info('-1 ContactUsController store $CMSItem ::' . print_r($CMSItem, true));
        if(empty($CMSItem)) {
            return response()->json([
                'message' => 'CMS item # "' . $cms_item_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $CMSItem->published     = 1;
            $CMSItem->updated_at = Carbon::now(config('app.timezone'));
            $CMSItem->save();
            \Log::info('-1 publish $cms_item_id::' . print_r($cms_item_id, true));

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 ContactUsController store $e->getMessage() ::' . print_r($e->getMessage(), true));
            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'CMSItem' => $CMSItem,
            'message' => 'CMS item was successfully publishedd',
        ], HTTP_RESPONSE_OK);
    } // public function publish(Request $request, int $cms_item_id)

    public function unpublish(Request $request, int $cms_item_id)
    {
        \Log::info('-1 unpublish $cms_item_id::' . print_r($cms_item_id, true));

        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'You have no access to CMS item unpublish method')
                ->with('flash_type', 'error');
        }

        $CMSItem = CMSItem
            ::getById($cms_item_id)
            ->first();
        if(empty($CMSItem)) {
            return response()->json([
                'message' => 'CMS item # "' . $cms_item_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $CMSItem->published     = 0;
            $CMSItem->updated_at = Carbon::now(config('app.timezone'));
            $CMSItem->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'CMSItem' => $CMSItem,
            'message' => 'CMS item was successfully unpublished',
        ], HTTP_RESPONSE_OK);
    } // public function unpublish(Request $request, int $cms_item_id)


}
