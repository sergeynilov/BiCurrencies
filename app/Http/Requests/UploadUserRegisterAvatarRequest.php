<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

class UploadUserRegisterAvatarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request = request();
        \Log::info(varDump($request, ' -1 UploadUserRegisterAvatarRequest $request::'));
        /*     [user_id] => 47
    [image_filename] => tony_black_full_photo.jpg
    [image] => Illuminate\Http\UploadedFile Object
        (
            [test:Symfony\Component\HttpFoundation\File\UploadedFile:private] =>
            [originalName:Symfony\Component\HttpFoundation\File\UploadedFile:private] => blob
            [mimeType:Symfony\Component\HttpFoundation\File\UploadedFile:private] => image/jpeg
            [error:Symfony\Component\HttpFoundation\File\UploadedFile:private] => 0
            [hashName:protected] =>
            [pathName:SplFileInfo:private] => /tmp/php7Q9NHQ
            [fileName:SplFileInfo:private] => php7Q9NHQ
        )

)
   */

        $uploaded_file_max_mib = (int)\Config::get('app.uploaded_file_max_mib', 10);
        $max_size              = 1024 * $uploaded_file_max_mib;  // 1024*2 = 2Mib
        \Log::info(varDump($max_size, ' -1 $max_size::'));

        $mimes_str         = '';
        $images_extensions = config('app.images_extensions', []);
        foreach ($images_extensions as $next_uploaded_documents_extension) {
            $mimes_str .= $next_uploaded_documents_extension . ',';
        }
        $mimes_str = trimRightSubString($mimes_str, ',');

        $avatar_dimension_limits = config('app.avatar_dimension_limits');
        $max_width               = $avatar_dimension_limits['max_width'] ?? 400;
        \Log::info(varDump($max_width, ' -1 $max_width::'));

        $rules = [
            'image'   => [
                'required',
                'max:' . $max_size,
                'dimensions:max_width=' . $max_width
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:' . (with(new User)->getTable()) . ',id'
            ]

        ];
        if ( ! empty($mimes_str)) {
            $rules['image'][] = 'mimes:' . $mimes_str;
        }
        \Log::info(varDump($rules, ' -1 UploadUserRegisterAvatarRequest $rules::'));

        return $rules;
    }

    public function messages()
    {
        $avatar_dimension_limits = config('app.avatar_dimension_limits');
        $max_width               = $avatar_dimension_limits['max_width'] ?? 400;
        $uploaded_file_max_mib   = (int)\Config::get('app.uploaded_file_max_mib', 1);

        $mimes_str         = '';
        $images_extensions = config('app.images_extensions', []);
        foreach ($images_extensions as $next_uploaded_documents_extension) {
            $mimes_str .= $next_uploaded_documents_extension . ', ';
        }
        $mimes_str = trimRightSubString($mimes_str, ', ');

        return [
            'image.dimensions' => 'Selected image is too big. Max permitted width : ' . $max_width . 'px',
            'image.max'        => 'Size of selected image cannot raise ' . $uploaded_file_max_mib . ' mb',
            'mimes'            => 'Not permitted image format. Permitted formats ' . $mimes_str,
        ];
    }
}
