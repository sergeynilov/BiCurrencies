<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
            'name' => 'backend_items_per_page',
            'value' => 4, //20,
        ]);
        \DB::table('settings')->insert([
            'name' => 'rate_decimal_numbers',
            'value' => 4,
        ]);
        \DB::table('settings')->insert([
            'name' => 'items_per_page',
            'value' => 20,
        ]);
        \DB::table('settings')->insert([
            'name' => 'site_name',
            'value' =>  'Currencies',
        ]);

        \DB::table('settings')->insert([
            'name' => 'copyright_text',
            'value' =>  'All rights reserved',
        ]);

        \DB::table('settings')->insert([
            'name' => 'site_heading',
            'value' =>  'Registering on our site you can get currency rates you need',
        ]);

        \DB::table('settings')->insert([
            'name' => 'base_currency',
            'value' =>  'CAD',
        ]);


    }
}
