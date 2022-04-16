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
                'collection_name'       => config('app.media_app_name'),
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
                'uuid'                  => '26584405-676e-4a8a-bacf-2635e38291e',
                'collection_name'       => config('app.media_app_name'),
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
                'uuid'                  => '2651905-676e-4a8a-bacf-2635e35291e',
                'collection_name'       => config('app.media_app_name'),
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
            array(
                'id'                    => 15,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 4,     //  4  => 'Philippine peso'
                'uuid'                  => '26519E35-676e-4L5a-ba3f-2645e35W31e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22de1962bca17184093c745e1c4a9b5',
                'file_name'             => 'philippine-peso.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 8240,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 15,
            ),
            array(
                'id'                    => 16,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 5,     //  5  => 'Danish krone'
                'uuid'                  => '26511q35-i26e-ij5a-boqf-2645e35wW9e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22de1962bca17184093c745e1c4a9b5',
                'file_name'             => 'danish_krone.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 11866,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 16,
            ),
            array(
                'id'                    => 17,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 6,     //  6  => 'Hungarian forint'
                'uuid'                  => '25q35-i26e-ij5a-boqf-2645e3wW5e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22de1962bca17184093c745e1c4a9b5',
                'file_name'             => 'hungarian_forint.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 15557,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 17,
            ),

            array(
                'id'                    => 18,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 7,     //  7  => 'Czechoslovak koruna'
                'uuid'                  => '25905-ioce-ij5a-94qf-264y23wW5e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b223e1te2bca1i784093sw45e1c4a865',
                'file_name'             => 'czechoslovak_koruna.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 9476,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 17,
            ),
            array(
                'id'                    => 19,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 8,     //  8  => 'Australian dollar'
                'uuid'                  => '2iu35-i2r3-i97a-bour-2645e3wite',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d0q962b2e1718406qc745e1ce39b5',
                'file_name'             => 'australian_dollar.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 8928,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 19,
            ),
            array(
                'id'                    => 20,
                'model_type'            => 'App\\Models\\Currency',
                'model_id'              => 9,     //  8  => 'Romanian leu'
                'uuid'                  => '25it5-ut6e-i87a-43qf-269ye3005e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d00262b2e1718346qc74546ce3st5',
                'file_name'             => 'romanian_leu.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 8577,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 20,
            ),
        ));

    }
}
