<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;


class CheckImageValidExtension implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /*
    'images_extensions'               => ['png', 'webp', 'jpg', 'jpeg', 'gif'],
    'uploaded_documents_extensions'   => ['png', 'webp', 'jpg', 'jpeg', 'gif', 'doc', 'xls', 'zip', 'rar'],
    'uploaded_file_max_mib'           => 14,
    'avatar_dimension_limits'         => ['max_width' => 64, 'max_height' => 64],
 */
        $imagesExtensions   = config('app.images_extensions');
        $filenameExtension= getFilenameExtension($value->getClientOriginalName());
        \Log::info(  varDump($filenameExtension, ' -1 CheckImageValidExtension $filenameExtension::') );
        if (!in_array($filenameExtension, $imagesExtensions)) {
            return false;
        }
        return true;
    }
    /*         $userUploadFile          = $request->file('avatar');
        $userUploadFullPhotoFile = $request->file('full_photo');

        $uploaded_file_max_mib = (int)\Config::get('app.uploaded_file_max_mib', 1);
        $max_size              = 1024 * $uploaded_file_max_mib;
        $rules                 = array(
            'avatar'     => 'max:' . $max_size,
            'full_photo' => 'max:' . $max_size,
        );
        $validator             = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ( ! empty($userUploadFile)) {
            $avatar_filename  = with(new Vote)->checkValidImgName($userUploadFile->getClientOriginalName(), with(new User)->getAvatarFilenameMaxLength(), true);
            $user_avatar_path = $userUploadFile->getPathName();

            if ( ! empty($avatar_filename)) {
                if (empty($this->session_id)) {
                    $this->session_id = Session::getId();
                }
                $avatar_filename_path = 'public/' . User::getUserAvatarTempDir($this->session_id) . $avatar_filename;
                $avatar_filename_url  = '/storage/' . User::getUserAvatarTempPath($this->session_id, $avatar_filename);

                Storage::disk('local')->put($avatar_filename_path, File::get($user_avatar_path));
                ImageOptimizer::optimize(storage_path() . '/app/' . $avatar_filename_path, null);
                $accountData                         = $request->session()->get($this->register_session_key);
                $accountData['avatar_filename']      = $avatar_filename;
                $accountData['avatar_filename_path'] = $avatar_filename_path;
                $accountData['avatar_filename_url']  = $avatar_filename_url;
                $request->session()->put($this->register_session_key, $accountData);
            } // if ( !empty($avatar_filename) ) {

        }
 */


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selected image with invalid extension';
    }
}
