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
        app(CreateNewUser::class)->create([
            'id' => 1,
            'name' => 'ShawnHadray',
            'email' => 'ShawnHadray@site.com',
            'password' => '111111',
            'status' => 'A',
            'account_type' => 'I',
            'first_name' => 'Shawn',
            'last_name' => 'Hadray',
            'phone' => '987-7543-916',
            'website' => 'shawn-hadray@site.com',
            'notes' => '<strong>shawn_hadray</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => 'shawn_hadray.jpg',
        ], true, [PERMISSION_APP_ADMIN, PERMISSION_ADD_HOSTEL, PERMISSION_EDIT_HOSTEL, PERMISSION_DELETE_HOSTEL, PERMISSION_ADD_PAGE, PERMISSION_EDIT_PAGE, PERMISSION_DELETE_PAGE]);

        app(CreateNewUser::class)->create([
            'id' => 2,
            'name' => 'PatLongred',
            'email' => 'PatLongred@site.com',
            'password' => '111111',
            'status' => 'A',
            'account_type' => 'I',
            'first_name' => 'Pat',
            'last_name' => 'Longred',
            'phone' => '987-7543-916',
            'website' => 'pat-longred@site.com',
            'notes' => '<strong>Pat Longred</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => '',
        ], true, []);

        app(CreateNewUser::class)->create([
            'id'         => 3,
            'name'       => 'John Doe',
            'email'      => 'john_doe@site.com',
            'password'   => '11111111',
            'status'     => 'A',

            'account_type' => 'I',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '987-7543-916',
            'website' => 'john-doe@site.com',
            'notes' => '<strong>John Doe</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => 'john_doe.jpg', // ok

        ], true, []);

        app(CreateNewUser::class)->create([
            'id'         => 4,
            'name'       => 'Jane Doe',
            'email'      => 'jane_doe@site.com',
            'password'   => '11111111',
            'status'     => 'A',

            'account_type' => 'I',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'phone' => '987-7543-916',
            'website' => 'jane-doe@site.com',
            'notes' => '<strong>Jane Doe</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => 'JaneDoe.jpg',

        ], true, []);



        app(CreateNewUser::class)->create([
            'id'         => 5,
            'name'       => 'Red Song',
            'email'      => 'red-song@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'account_type' => 'I',
            'first_name' => 'Red',
            'last_name' => 'Song',
            'phone' => '247-541-7172',
            'website' => 'red-song@site.com',
            'notes' => '<strong>Red Song</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2018-03-25 12:39:36',
            'avatar' => '5.jpeg',
        ], true, []);


        app(CreateNewUser::class)->create([
            'id'         => 6,
            'name'       => 'Black Book',
            'email'      => 'black-book@site.com',
            'password'   => '11111111',
            'status'     => 'A',
            'account_type' => 'I',
            'first_name' => 'Black',
            'last_name' => 'Book',
            'phone' => '284-921-7970',
            'website' => 'black-book@make-hostels2.site.com',
            'notes' => '<strong>Black Book</strong> Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum. Sed  ut perspiciatis unde omnis iste natus error sit voluptatem accusantium  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?

Sed  ut perspiciatis unde omnis iste natus error sit <strong><i>voluptatem accusantium</i></strong>  doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo  inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?
',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => 'black-book.jpeg',
        ], true, []);


        app(CreateNewUser::class)->create([
            'id'         => 7,
            'name' => 'ShaonHahroy',
            'email' => 'customer1@hostels21-site.com',
            'password' => '111111',
            'status' => 'A',
            'account_type' => 'B',
            'first_name' => 'Shaon',
            'last_name' => 'Hahroy',
            // 'current_team_id' => 1,
            'phone' => '7659879638765',
            'website' => 'http://shaon-hahroy@hostels21-site.com',
            'notes' => 'Some notes on <strong>Shaon Hahroy</strong>, who lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.
lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => NULL,
        ], true, []);

        app(CreateNewUser::class)->create([
            'id' => 8,
            'name' => 'BlackAdams',
            'email' => 'BlackAdams@hostels232.site.com',
            'password' => '111111',
            'status' => 'A',
            'account_type' => 'I',
            'first_name' => 'Black',
            'last_name' => 'Adams',
            // 'current_team_id' => 1,
            'phone' => '7659289638745',
            'website' => 'http://customer2@hostels22-site.com',
            'notes' => 'Some notes on <strong>Black Adams</strong>, who lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.
lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => NULL,
            ], true, []);

        app(CreateNewUser::class)->create([
            'id' => 9,
            'name' => 'MarthaLang',
            'email' => 'MarthaLang@hostels23-site.com',
            'password' => '111111',
            'status' => 'N',
            'account_type' => 'B',
            'first_name' => 'Martha',
            'last_name' => 'Lang',
            // 'current_team_id' => 1,
            'phone' => '7659879638765',
            'website' => 'http://customer3@hostels23.site.com',
            'notes' => 'Some notes on <strong>Martha Lang</strong>, who lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.
lorem <i>ipsum dolor sit</i> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.',
            'activated_at' => '2019-04-29 11:03:50',
            'avatar' => NULL,
        ], true, []);


        \DB::table('media')->insert(array(
            array(
                'id'                    => 11,
                'model_type'            => 'App\\Models\\User',
                'model_id'              => 1,
                'uuid'                  => '26519405-106e-4a8a-bacf-2693e374191e',
                'collection_name'       => 'app_images',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'shawn_hadray.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 5151,
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
                'collection_name'       => 'app_images',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'john_doe.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 1215,
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
                'collection_name'       => 'app_images',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => 'JaneDoe.jpg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => '5163',
                'size'                  => 5151,
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
                'collection_name'       => 'app_images',
                'name'                  => 'b22de6732bca17190523c285e1c4a9b5',
                'file_name'             => '5.jpeg',
                'mime_type'             => 'image/jpg',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 1561,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 14,
            ),
        ));

    }
}

