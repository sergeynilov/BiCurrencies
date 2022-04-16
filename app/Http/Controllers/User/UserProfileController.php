<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\UserResource;
use App\Library\CheckValueType;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! isUserLogged()) {
            return redirect(route('login'))
                ->with('flash', 'You are not logged')
                ->with('flash_type', 'error');
        }


        $profileUser                  = auth()->user();
        $profile_user_media_image_url = '';
        foreach ($profileUser->getMedia(config('app.media_app_name')) as $mediaImage) {
            if (File::exists($mediaImage->getPath())) {
//                    \Log::info(varDump($mediaImage->getUrl(), ' -1 EXISTS $mediaImage->getUrl()::'));
                $profile_user_media_image_url = $mediaImage->getUrl();
                break;
            }
        }

        if(empty($profile_user_media_image_url)) {
            $profile_user_media_image_url = '/images/default-avatar.png';
        }
        $profileUserPermissions = $profileUser->permissions;

        return Inertia::render('User/Profile/Index', [
            'profileUser'                  => $profileUser,
            'profileUserPermissions'       => $profileUserPermissions,
            'profile_user_media_image_url' => $profile_user_media_image_url,
        ]);

    }


}
