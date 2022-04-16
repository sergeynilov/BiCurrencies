<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//use App\Models\Settings;

class UploadSettingsImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request = request();
        \Log::info(varDump($request, ' -1 UploadSettingsImageRequest $request::'));
        $uploaded_file_max_mib = (int)\Config::get('app.uploaded_file_max_mib', 10);
        $max_size              = 1024 * $uploaded_file_max_mib;  // 1024*2 = 2Mib
//        \Log::info(  varDump($max_size, ' -1 $max_size::') );

        $mimes_str= '';
        $images_extensions = config('app.images_extensions', []);
        foreach( $images_extensions as $next_uploaded_documents_extension ) {
            $mimes_str.= $next_uploaded_documents_extension.',';
        }
        $mimes_str= trimRightSubString($mimes_str, ',');

        $app_logo_dimension_limits = config('app.app_logo_dimension_limits');
        $max_width              = $app_logo_dimension_limits['max_width'] ?? 400;
        \Log::info(  varDump($max_width , ' -1 $max_width::') );
        $max_height              = $app_logo_dimension_limits['max_height'] ?? 400;
        \Log::info(  varDump($max_height , ' -1 $max_height::') );

        $rules= [
            'image' => [
                'required',
                //                'mimes:jpeg,png,jpg',
                'max:' . $max_size,
                'dimensions:max_width=' . $max_width.'|max_height=' . $max_height
            ]
        ];
        if(!empty($mimes_str)) {
            $rules['image'][] = 'mimes:'.$mimes_str;
        }
        \Log::info(  varDump($rules, ' -1 UploadSettingsImageRequest $rules::') );
        return $rules;
    }

    public function messages()
    {
        $app_logo_dimension_limits = config('app.app_logo_dimension_limits');
        $max_width              = $app_logo_dimension_limits['max_width'] ?? 400;
        $uploaded_file_max_mib  = (int)\Config::get('app.uploaded_file_max_mib', 1);

        $mimes_str= '';
        $images_extensions = config('app.images_extensions', []);
        foreach( $images_extensions as $next_uploaded_documents_extension ) {
            $mimes_str.= $next_uploaded_documents_extension.', ';
        }
        $mimes_str= trimRightSubString($mimes_str, ', ');

        return [
            'image.dimensions'    => 'Selected image is too big. Max permitted width : ' . $max_width . 'px',
            'image.max'           => 'Size of selected image cannot raise ' . $uploaded_file_max_mib . ' mb',
            'mimes' => 'Not permitted image format. Permitted formats ' . $mimes_str,
        ];
    }
}
