<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use App\Models\CMSItem;
use App\Library\CheckValueType;

//use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

//use Illuminate\Http\Resources\Json\ResourceCollection;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\File;
use App\Http\Resources\UserResource;
use Inertia\Inertia;
use Auth;
use Session;
use DB;
use Spatie\Image\Image;


class ProfileController extends Controller  //    http://127.0.0.1:8000/current_rates
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $user_id)
    {
        \Log::info(varDump($user_id, ' -1 profileUser  user_id::'));

        return Inertia::render('Profile/Index',
            ['profile_user_id' => $user_id]
        );
    }

    public function load_user_profile_data($user_id)
    {
        $profile_user_media_image_url = '';
        $profileUser                  = User
            ::getByStatus('A')
            ->getById($user_id)
            ->first();

        foreach ($profileUser->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
//                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                $profile_user_media_image_url = $mediaImage->getUrl();
                break;
            }
        }

        if (empty($profile_user_media_image_url)) {
            $profile_user_media_image_url = '/images/default-avatar.png';
        }

        $profileUserPermissions = $profileUser->permissions;

        return response()->json([
            'profileUser'                  => $profileUser,
            'profile_user_media_image_url' => $profile_user_media_image_url,
            'profileUserPermissions'       => $profileUserPermissions
        ], HTTP_RESPONSE_OK);
    } // public function load_user_profile_data()

    public function load_author_articles($user_id)
    {
        $request        = request();
        $items_per_page = Settings::getValue('items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($items_per_page, ' -1 load_author_articles $items_per_page::'));
        $page           = $request->page ?? 1;
        $authorArticles = CMSItem
            ::getByAuthorId($user_id)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($authorArticles as $next_key => $nextAuthorArticle) {
            $has_image = false;
            foreach ($nextAuthorArticle->getMedia(config('app.media_app_name')) as $mediaImage) {
                if (File::exists($mediaImage->getPath())) {
                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
//                         $authorArticles[$next_key]->author = $nextAuthor;
                    $authorArticles[$next_key]->media_image_url = $mediaImage->getUrl();
                    $has_image                                  = true;
                    break;
                }
            }
            if ( ! $has_image) {
                $authorArticles[$next_key]->media_image_url = '/images/default-article.png';
//                     $authorArticles[$next_key]->author = $nextAuthor;
            }
        }
//            ->paginate($items_per_page, array('*'), 'page', $page);
        \Log::info(varDump($authorArticles, ' -1 load_author_articles authorArticles::'));

        return response()->json([
            'authorArticles' => $authorArticles
        ], HTTP_RESPONSE_OK);
    } // public function load_author_articles()


}
