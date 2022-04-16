<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {

        $is_admin= auth()->user()->can(ACCESS_APP_ADMIN_LABEL);
        if($is_admin) {
            return redirect()->intended(route('admin.dashboard.index'));
        }


        $is_support_manager= auth()->user()->can(ACCESS_APP_SUPPORT_MANAGER_LABEL);
        if($is_support_manager) {
            return redirect()->intended(route('admin.contact_us.index'));
        }


        $is_content_editor= auth()->user()->can(ACCESS_APP_CONTENT_EDITOR_LABEL);
        if($is_content_editor) {
            return redirect()->intended(route('admin.cms_items.index'));
        }


        return redirect()->intended(route('user.profile.index'));
    }
}
