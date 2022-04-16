<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;


class UsersTableSeeder extends Seeder
{

    public function run()
    {

//        \DB::table('users')->delete();
        /*     define("ACCESS_APP_ADMIN", 1);  // Admin
    define("ACCESS_APP_SUPPORT_MANAGER", 2);
    define("ACCESS_APP_CONTENT_EDITOR", 3); */
        app(CreateNewUser::class)->create([
            'id' => 1,
            'name' => 'Shawn Hadray',
            'email' => 'ShawnHadray@site.com',
            'password' => '111111',
            'status' => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',
        ], true, [ ACCESS_APP_ADMIN_LABEL, ACCESS_APP_SUPPORT_MANAGER_LABEL, ACCESS_APP_CONTENT_EDITOR_LABEL]);

        app(CreateNewUser::class)->create([
            'id' => 2,
            'name' => 'Pat Longred',
            'email' => 'PatLongred@site.com',
            'password' => '111111',
            'status' => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',
//            'avatar' => '',
        ], true, [ ACCESS_APP_SUPPORT_MANAGER_LABEL, ACCESS_APP_CONTENT_EDITOR_LABEL]);

        app(CreateNewUser::class)->create([
            'id'         => 3,
            'name'       => 'John Doe',
            'email'      => 'john_doe@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',

        ], true, [ ACCESS_APP_CONTENT_EDITOR_LABEL]);

        app(CreateNewUser::class)->create([
            'id'         => 4,
            'name'       => 'Jane Doe',
            'email'      => 'jane_doe@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',

        ], true, [ACCESS_APP_SUPPORT_MANAGER_LABEL, ACCESS_APP_CONTENT_EDITOR_LABEL]);



        app(CreateNewUser::class)->create([
            'id'         => 5,
            'name'       => 'Red Song',
            'email'      => 'red-song@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'email_verified_at' => '2018-03-25 12:39:36',
//            'avatar' => '5.jpeg',
        ], true, [ACCESS_APP_ADMIN_LABEL, ACCESS_APP_SUPPORT_MANAGER_LABEL]);


        app(CreateNewUser::class)->create([
            'id'         => 6,
            'name'       => 'Black Book',
            'email'      => 'black-book@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',
//            'avatar' => 'black-book.jpeg',
        ], true, [ACCESS_APP_CONTENT_EDITOR_LABEL]);


        app(CreateNewUser::class)->create([
            'id'         => 7,
            'name' => 'Shaon Hahroy',
            'email' => 'customer1@site.com',
            'password' => '111111',
            'status' => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',
//            'avatar' => NULL,
        ], true, [ACCESS_APP_ADMIN_LABEL, ACCESS_APP_SUPPORT_MANAGER_LABEL, ACCESS_APP_CONTENT_EDITOR_LABEL]);

        app(CreateNewUser::class)->create([
            'id' => 8,
            'name' => 'BlackAdams',
            'email' => 'BlackAdams@site.com',
            'password' => '111111',
            'status' => 'A',
            'email_verified_at' => '2019-04-29 11:03:50',
//            'avatar' => NULL,
        ], true, [ACCESS_APP_CONTENT_EDITOR_LABEL]);

        app(CreateNewUser::class)->create([
            'id' => 9,
            'name' => 'MarthaLang',
            'email' => 'MarthaLang@site.com',
            'password' => '111111',
            'status' => 'N',
            'email_verified_at' => '2019-04-29 11:03:50',
//            'avatar' => NULL,
        ], true, [ACCESS_APP_CONTENT_EDITOR_LABEL]);


        \DB::table('media')->insert(array(
            array(
                'id'                    => 11,
                'model_type'            => 'App\\Models\\User',
                'model_id'              => 1,
                'uuid'                  => '26519405-106e-4a8a-bacf-2693e374191e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'shawn_hadray.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 38235,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 11,
            ),
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 12,
                'model_type'            => 'App\\Models\\User',
                'model_id'              => 3,
                'uuid'                  => '26519615-106e-4a8a-biyf-2693e370531e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'john_doe.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 25670,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 12,
            ),
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 13,
                'model_type'            => 'App\\Models\\User',
                'model_id'              => 4,
                'uuid'                  => '26982405-106e-4a8a-bisf-2693e375211e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'JaneDoe.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => '5163',
                'size'                  => 96150,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 13,
            ),
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 14,
                'model_type'            => 'App\\Models\\User',
                'model_id'              => 5,
                'uuid'                  => '26586415-106e-4a3a-biyf-2691o370291e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'RedSong.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 29904,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 14,
            ),
        ));

    }
}

