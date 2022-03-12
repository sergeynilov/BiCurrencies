<?php

namespace App\Library\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use DB;
//use App\Models\Hostel;
//use App\Models\HostelRoom;
use App\Models\User;
use Illuminate\Database\QueryException;
//use App\Mail\ReportToSupportOnAction;
use App\Models\CMSItem;

class AppContent
{
    public const WATERMARK_PATH = '/img/hostels_brand_small.jpg'; //         $watermark_path = public_path('/img/hostels_brand_small.jpg');

    public const BIG_LOGO = '/img/logo.jpg';
    public const SVG_SMALL_LOGO = '/img/logo.svg';
    public const EMPTY_IMAGE = '/img/emptyImg.png';
    public const BG_IMAGE_HEADER_HOSTEL = '/img/header_hostel.jpeg';
    public const BG_IMAGE_HOSTEL_SERVICES = '/img/hostel_services.jpg';
    public const BG_IMAGE_HOSTELS_GALLERY = '/img/hostels-gallery.jpg';
    public const BG_IMAGE_HOSTEL_FOR_VIEW = '/img/hostel_for_view.jpg';
    public const BG_IMAGE_REGISTER_2 = '/img/register_bg_2.png';
    public const WATERMARK_SMALL_IMAGE = '/img/hostels_brand_small.jpg';

    public const NOT_FOUND_404_BIG_IMAGE = '/img/404.png';
    public const UNAVAILABLE_503_BIG_IMAGE = '/img/unavailable.jpg';

    public function getBlockCMSItem( $key, $return_array = true)
    {
        $cMSItem = CMSItem
            ::getByKey($key)
            ->first();
        if (empty($cMSItem)) {
            return $return_array ? [] : null;
        }
        return $return_array ? $cMSItem->toArray() : $cMSItem;
    } // public function getBlockCMSItem($key)


    function addWatermarkToImage(string $source_file_path): bool
    {
//        \Log::info( '-1 addWatermarkToImage $source_file_path::' . print_r(  $source_file_path, true  ) );
        $watermark_image_path = config('app.watermark_image_path', '');
        if(empty($watermark_image_path)) {
            \Log::info( '-1 $ ::' . print_r(  'WATERMARK OPTION IS EMPTY !', true  ) );
            return false;
        }

        $watermark_path= public_path($watermark_image_path);
        if(!file_exists($watermark_path)) {
            \Log::info( '-1 $ ::' . print_r(  'WATERMARK FILE NOT FOUND !', true  ) );
            return false;
        }

        $watermark =  \Image::make( $watermark_path );
        $watermark->opacity(50);
        \Log::info( '-2 $ ::' . print_r(  -2, true  ) );

        $src_image_path= $source_file_path;
        \Log::info( '-1 $src_image_path ::' . print_r(  $src_image_path, true  ) );
        if(!file_exists($src_image_path)) {
            return false;
        }

        $src_image_path_ext= getFilenameExtension($src_image_path);

        $srcImageObject = \Image::make($src_image_path);
//        \Log::info( '-3 $ :: SOURCE FILE NOT FOUND! ' . print_r(  -3, true  ) );

        $srcImageObject->insert($watermark, 'bottom-right', 10, 10);
        if(strtolower($src_image_path_ext) == 'jpg' or strtolower($src_image_path_ext) == 'jpeg') {
            $srcImageObject->encode('jpg', 100);
        }
        if(strtolower($src_image_path_ext) == 'png') {
            $srcImageObject->encode('png', 100);
        }
        if(strtolower($src_image_path_ext) == 'webp') {
            $srcImageObject->encode('webp', 100);
        }
        $srcImageObject->save($source_file_path);
        \Log::info(  varDump($source_file_path, ' -1 $source_file_path::') );

        return true;
    }

}


