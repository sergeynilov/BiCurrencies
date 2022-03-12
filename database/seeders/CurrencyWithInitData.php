<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()  //  https://fontawesome.com/v5/search?c=currency
    {
        \DB::table('currency')->insert([
            'name'      => 'Canadian dollar',
            'char_code' => 'CAD',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 124,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 6,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Hong Kong dollar',  //?
            'char_code' => 'HKD',
            'color' => '#ffffff',   // white
            'bgcolor' => '#28A745',   // green
            'num_code'  => 344,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 13,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Icelandic króna', //?
            'char_code' => 'ISK',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 352,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 11,

        ]);
        \DB::table('currency')->insert([
            'name'      => 'Philippine peso',
            'char_code' => 'PHP',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 608,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 12,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Danish krone',
            'char_code' => 'DKK',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // OK
            'num_code'  => 208,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 14,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Hungarian forint',
            'char_code' => 'HUF',
            'color' => '#C7293D',   // dark red
            'bgcolor' => '#ffffff',   // white OK
            'num_code'  => 348,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 15,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Czechoslovak koruna',
            'char_code' => 'CZK',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white OK
            'num_code'  => 200,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 16,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Australian dollar',
            'char_code' => 'AUD',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 036,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 3,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Romanian leu',
            'char_code' => 'RON',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#F4CA15',   // dark yellow
            'num_code'  => 642,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 17,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Swedish krona/kronor',
            'char_code' => 'SEK',
            'color' => '#ffff00',   // yellow
            'bgcolor' =>  '#0036A3',   // blue
            'num_code'  => 752,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 18,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Indonesian rupiah',
            'char_code' => 'IDR',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 360,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 19,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Indian rupee',
            'char_code' => 'INR',
            'color' => '#ffaa00',   //
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 356,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 20,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Brazilian cruzeiro',
            'char_code' => 'BRL',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#28A745',   // green
            'num_code'  => 076,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 21,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Russian ruble',
            'char_code' => 'RUB',
            'color' => '#ffffff',   // white
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 810,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 22,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Croatian kuna',
            'char_code' => 'HRK',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 191,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 23,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Japanese yen',
            'char_code' => 'JPY',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 392,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 24,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Thai baht',
            'char_code' => 'THB',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 764,
            'is_top'    => false,
            'active'    => false,
            'ordering'  => 25,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Swiss franc',
            'char_code' => 'CHF',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 756,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 26,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Singapore dollar',
            'char_code' => 'SGD',
            'color' => '#7C0A17',   // dark red
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 702,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 27,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Polish zloty',
            'char_code' => 'PLN',
            'color' => '#ffffff',   // white
            'bgcolor' => '#7C0A17',   // dark red
            'num_code'  => 616,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 28,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Bulgarian lev',
            'char_code' => 'BGN',
            'color' => '#ffffff',   // white
            'bgcolor' =>  '#28A745',   // green
            'num_code'  => 975,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 29,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Turkish lira',
            'char_code' => 'TRY',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 979,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 30,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Chinese yuan',
            'char_code' => 'CNY',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 156,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 31,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Norwegian krone',
            'char_code' => 'NOK',
            'color' => '#001F58',   // dark blue
            'bgcolor' =>  '#7C0A17',   // dark red
            'num_code'  => 578,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 32,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'New Zealand dollar',
            'char_code' => 'NZD',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#001F58',   // dark blue
            'num_code'  => 544,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 33,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'South African rand',
            'char_code' => 'ZAR',
            'color' => '#28A745',   // green
            'bgcolor' => '#001F58',   // dark blue
            'num_code'  => 710,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 34,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'United States dollar',
            'char_code' => 'USD',
            'color' => '#ffffff',   // white
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 840,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 1,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Mexican peso',
            'char_code' => 'MXN',
            'color' =>  '#28A745',   // green
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 484,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 35,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Israeli new shekel',
            'char_code' => 'ILS',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 376,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 36,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Pound sterling',
            'char_code' => 'GBP',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 826,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 2,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'South Korean won',
            'char_code' => 'KRW',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 410,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 37,
        ]);
        \DB::table('currency')->insert([
            'name'      => 'Malaysian ringgit',
            'char_code' => 'MYR',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 458,
            'is_top'    => false,
            'active'    => false,
            'ordering'  => 38,
        ]);
    }
}
