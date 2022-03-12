<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class currencyMediaWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \DB::table('media')->insert(array(
            array(
                'id'                    => 1,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 1,
                'uuid'                  => '26592405-676e-4a8a-bacf-2635e385791e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6791bca17184093c285e1c4b4b5',
                'file_name'             => 'canadian_dollar.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 8709,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 1,
            ),
            array(
                'id'                    => 2,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 2,
                'uuid'                  => '26584405-676e-4a8a-bacf-2635e382191e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de6762bca17184093c285e1c4a9b5',
                'file_name'             => 'hong-kong-dollar.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 7113,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 2,
            ),


            array(
                'id'                    => 3,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 3,
                'uuid'                  => '26519005-676e-4a8a-bacf-2635e351291e',
                'collection_name'       => 'currency_app',
                'name'                  => 'b22de1962bca17184093c745e1c4a9b5',
                'file_name'             => 'icelandic-krona.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 19764,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 3,
            ),
        ));

    }
}
