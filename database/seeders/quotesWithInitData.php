<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class quotesWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        return;
        \DB::table('quotes')->delete();

        /*

            A weak currency is the sign of a weak economy, and a weak economy leads to a weak nation.
        Ross Perot



        In times of crisis, credibility is an American president's most valuable currency.
Antony Blinken


        This is what the European Union is all about. A strong market with a strong currency.

Mark Rutte

        */

        \DB::table('quotes')->insert(array(
                array(
                    'id'    => 1,
                    'author_name' => 'Ernest Hemingway',
                    'occupation' => 'American writer',
                    'key'   => 'ernest_hemingway_panacea_quote',
                    'text'  => 'The first panacea for a mismanaged nation is inflation of the currency; the second is war. Both bring a temporary prosperity; both bring a permanent ruin. But both are the refuge of political and economic opportunists.',
                    'published'=> true,
                ),
                array(
                    'id'    => 2,
                    'author_name' => 'Ross Perot',
                    'occupation' => 'American businessman and politician',
                    'key'   => 'ross_perot_a_weak_currency_quote',
                    'text'  => 'A weak currency is the sign of a weak economy, and a weak economy leads to a weak nation.',
                    'published'=> true,
                ),
                array(
                    'id'    => 3,
                    'author_name' => 'Antony Blinken',
                    'occupation' => 'American diplomat',
                    'key'   => 'antony_linken_credibility_quote',
                    'text'  => 'In times of crisis, credibility is an American president\'s most valuable currency.',
                    'published'=> true,
                ),
                array(
                    'id'    => 4,
                    'author_name' => 'Mark Rutte',
                    'key'   => 'mark_rutte_quote',
                    'occupation' => 'Dutch politician',
                    'text'  => 'This is what the European Union is all about. A strong market with a strong currency.',
                    'published'=> true,
                ),
                array(
                    'id'    => 5,
                    'author_name' => 'Kevin O\'Leary',
                    'key'   => 'kevin_o_leary_quote',
                    'occupation' => 'Canadian businessman',
                    'text'  => 'Money is my military, each dollar a soldier. I never send my money into battle unprepared and undefended. I send it to conquer and take currency prisoner and bring it back to me',
                    'published'=> true,
                ),
        ));


        \DB::table('media')->insert(array(
            array(
                'id'                    => 22,
                'model_type'            => 'App\\Models\\Quote',
                'model_id'              => 1,
                'uuid'                  => '2g494305-946e-443a-bi4u-263k938a391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b298e6fe14wa1de84hy3cl75e1c5r4b5',
                'file_name'             => 'ernest_hemingway.jpeg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 6431,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 22,
            ),

            array(
                'id'                    => 23,
                'model_type'            => 'App\\Models\\Quote',
                'model_id'              => 2,
                'uuid'                  => '2g494334-9421-4411-b53u-264593i6391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b298r4feewwa1958rey3o9754wc5ro75',
                'file_name'             => 'ross_perot.jpg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 17520,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 23,
            ),

            array(
                'id'                    => 24,
                'model_type'            => 'App\\Models\\Quote',
                'model_id'              => 3,
                'uuid'                  => '2g4ji334-4521-q211-bseu-w64597i6391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => '8u98r42wewwa1fe8rey3owa54wc3eo75',
                'file_name'             => 'antony_blinken.jpg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 348299,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 24,
            ),

            array(
                'id'                    => 25,
                'model_type'            => 'App\\Models\\Quote',
                'model_id'              => 4,
                'uuid'                  => '2g4jre34-4fu1-q2d1-b2au-w10597o3391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => '8u98r42qsewwa3we8rey3owa54wcero75',
                'file_name'             => 'mark_rutte.jpeg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 6485,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 25,
            ),

            array(
                'id'                    => 26,
                'model_type'            => 'App\\Models\\Quote',
                'model_id'              => 5,
                'uuid'                  => '2g4j7i34-4f09-q971-b285-w16t97o3091e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => '8u98r4resewwa37h8rey3o8554wc32o75',
                'file_name'             => 'kevin_o_leary.jpeg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 31506,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 26,
            ),


        ));


    }
}
