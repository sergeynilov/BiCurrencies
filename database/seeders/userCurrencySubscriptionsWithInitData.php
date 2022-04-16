<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userCurrencySubscriptionsWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_currency_subscriptions')->delete();

        \DB::table('user_currency_subscriptions')->insert(array(
            array(
                'user_id'     => 1,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 1,
                'currency_id' => 3,
            ),

            array(
                'user_id'     => 1,
                'currency_id' => 4,
            ),
            array(
                'user_id'     => 1,
                'currency_id' => 5,
            ),

            array(
                'user_id'     => 1,
                'currency_id' => 6,
            ),

            array(
                'user_id'     => 1,
                'currency_id' => 9,
            ),

            array(
                'user_id'     => 2,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 2,
                'currency_id' => 3,
            ),

            array(
                'user_id'     => 2,
                'currency_id' => 6,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 2,
            ),


            array(
                'user_id'     => 5,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 7,
                'currency_id' => 3,
            ),

            array(
                'user_id'     => 7,
                'currency_id' => 6,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 2,
            ),

            array(
                'user_id'     => 2,
                'currency_id' => 5,
            ),

            array(
                'user_id'     => 7,
                'currency_id' => 10,
            ),

            array(
                'user_id'     => 8,
                'currency_id' => 11,
            ),


            //////////
            array(
                'user_id'     => 8,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 8,
                'currency_id' => 13,
            ),

            array(
                'user_id'     => 8,
                'currency_id' => 16,
            ),

            array(
                'user_id'     => 5,
                'currency_id' => 2,
            ),


            array(
                'user_id'     => 5,
                'currency_id' => 4,
            ),


            array(
                'user_id'     => 5,
                'currency_id' => 7,
            ),


            array(
                'user_id'     => 5,
                'currency_id' => 8,
            ),


            array(
                'user_id'     => 5,
                'currency_id' => 9,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 5,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 7,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 8,
            ),

            array(
                'user_id'     => 6,
                'currency_id' => 12,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 1,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 4,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 5,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 7,
            ),

            array(
                'user_id'     => 9,
                'currency_id' => 8,
            ),



        ));


    }
}
