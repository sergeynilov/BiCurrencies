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
        \DB::table('currencies')->insert([
            'id'                    => 1,
            'name'      => 'Canadian dollar',
            'char_code' => 'CAD',
            'description' => '<p><strong>Canadian dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 124,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 6,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 2,
            'name'      => 'Hong Kong dollar',  //?
            'char_code' => 'HKD',
            'description' => '<p><strong>Hong Kong dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#28A745',   // green
            'num_code'  => 344,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 13,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 3,
            'name'      => 'Icelandic króna', //?
            'char_code' => 'ISK',
            'description' => '<p><strong>Icelandic króna</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 352,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 11,

        ]);
        \DB::table('currencies')->insert([
            'id'                    => 4,
            'name'      => 'Philippine peso',
            'char_code' => 'PHP',
            'description' => '<p><strong>Philippine peso</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 608,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 12,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 5,
            'name'      => 'Danish krone',
            'char_code' => 'DKK',
            'description' => '<p><strong>Danish krone</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // OK
            'num_code'  => 208,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 14,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 6,
            'name'      => 'Hungarian forint',
            'char_code' => 'HUF',
            'description' => '<p><strong>Hungarian forint</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#C7293D',   // dark red
            'bgcolor' => '#ffffff',   // white OK
            'num_code'  => 348,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 15,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 7,
            'name'      => 'Czechoslovak koruna',
            'char_code' => 'CZK',
            'description' => '<p><strong>Czechoslovak koruna</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white OK
            'num_code'  => 200,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 16,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 8,
            'name'      => 'Australian dollar',
            'char_code' => 'AUD',
            'description' => '<p><strong>Australian dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 036,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 3,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 9,
            'name'      => 'Romanian leu',
            'char_code' => 'RON',
            'description' => '<p><strong>Romanian leu</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#F4CA15',   // dark yellow
            'num_code'  => 642,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 17,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 10,
            'name'      => 'Swedish krona/kronor',
            'char_code' => 'SEK',
            'description' => '<p><strong>Swedish krona/kronor</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffff00',   // yellow
            'bgcolor' =>  '#0036A3',   // blue
            'num_code'  => 752,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 18,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 11,
            'name'      => 'Indonesian rupiah',
            'char_code' => 'IDR',
            'description' => '<p><strong>Indonesian rupiah</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 360,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 19,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 12,
            'name'      => 'Indian rupee',
            'char_code' => 'INR',
            'description' => '<p><strong>Indian rupee</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffaa00',   //
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 356,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 20,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 13,
            'name'      => 'Brazilian cruzeiro',
            'char_code' => 'BRL',
            'description' => '<p><strong>Brazilian cruzeiro</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#28A745',   // green
            'num_code'  => 076,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 21,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 14,
            'name'      => 'Russian ruble',
            'char_code' => 'RUB',
            'description' => '<p><strong>Russian ruble</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 810,
            'is_top'    => false,
            'active'    => false,
            'ordering'  => 22,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 15,
            'name'      => 'Croatian kuna',
            'char_code' => 'HRK',
            'description' => '<p><strong>Croatian kuna</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 191,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 23,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 16,
            'name'      => 'Japanese yen',
            'char_code' => 'JPY',
            'description' => '<p><strong>Japanese yen</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 392,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 24,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 17,
            'name'      => 'Thai baht',
            'char_code' => 'THB',
            'description' => '<p><strong>Thai baht</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 764,
            'is_top'    => false,
            'active'    => false,
            'ordering'  => 25,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 18,
            'name'      => 'Swiss franc',
            'char_code' => 'CHF',
            'description' => '<p><strong>Swiss franc</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 756,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 26,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 19,
            'name'      => 'Singapore dollar',
            'char_code' => 'SGD',
            'description' => '<p><strong>Singapore dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#7C0A17',   // dark red
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 702,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 27,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 20,
            'name'      => 'Polish zloty',
            'char_code' => 'PLN',
            'description' => '<p><strong>Polish zloty</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#7C0A17',   // dark red
            'num_code'  => 616,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 28,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 21,
            'name'      => 'Bulgarian lev',
            'char_code' => 'BGN',
            'description' => '<p><strong>Bulgarian lev</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' =>  '#28A745',   // green
            'num_code'  => 975,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 29,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 22,
            'name'      => 'Turkish lira',
            'char_code' => 'TRY',
            'description' => '<p><strong>Turkish lira</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 979,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 30,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 23,
            'name'      => 'Chinese yuan',
            'char_code' => 'CNY',
            'description' => '<p><strong>Chinese yuan</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#DC3545',   // red OK
            'num_code'  => 156,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 31,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 24,
            'name'      => 'Norwegian krone',
            'char_code' => 'NOK',
            'description' => '<p><strong>Norwegian krone</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#001F58',   // dark blue
            'bgcolor' =>  '#7C0A17',   // dark red
            'num_code'  => 578,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 32,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 25,
            'name'      => 'New Zealand dollar',
            'char_code' => 'NZD',
            'description' => '<p><strong>New Zealand dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#001F58',   // dark blue
            'num_code'  => 544,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 33,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 26,
            'name'      => 'South African rand',
            'char_code' => 'ZAR',
            'description' => '<p><strong>South African rand</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#28A745',   // green
            'bgcolor' => '#001F58',   // dark blue
            'num_code'  => 710,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 34,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 27,
            'name'      => 'United States dollar',
            'char_code' => 'USD',
            'description' => '<p><strong>United States dollar</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffffff',   // white
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 840,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 1,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 28,
            'name'      => 'Mexican peso',
            'char_code' => 'MXN',
            'description' => '<p><strong>Mexican peso</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' =>  '#28A745',   // green
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 484,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 35,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 29,
            'name'      => 'Israeli new shekel',
            'char_code' => 'ILS',
            'description' => '<p><strong>Israeli new shekel</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#0036A3',   // blue
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 376,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 36,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 30,
            'name'      => 'Pound sterling',
            'char_code' => 'GBP',
            'description' => '<p><strong>Pound sterling</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#ffffff',   // white
            'num_code'  => 826,
            'is_top'    => true,
            'active'    => true,
            'ordering'  => 2,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 31,
            'name'      => 'South Korean won',
            'char_code' => 'KRW',
            'description' => '<p><strong>South Korean won</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#DC3545',   // red OK
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 410,
            'is_top'    => false,
            'active'    => true,
            'ordering'  => 37,
        ]);
        \DB::table('currencies')->insert([
            'id'                    => 32,
            'name'      => 'Malaysian ringgit',
            'char_code' => 'MYR',
            'description' => '<p><strong>Malaysian ringgit</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
            'color' => '#ffff00',   // yellow
            'bgcolor' => '#0036A3',   // blue
            'num_code'  => 458,
            'is_top'    => false,
            'active'    => false,
            'ordering'  => 38,
        ]);
    }
}
