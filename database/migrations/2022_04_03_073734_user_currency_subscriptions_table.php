<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_currency_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->tinyInteger('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('CASCADE');

            $table->timestamp('created_at')->useCurrent();

            $table->index(['created_at'], 'user_currency_subscriptions_created_at_index');
            $table->unique(['user_id', 'currency_id'], 'user_currency_subscriptions_user_id_currency_id_unique');
        });
        Artisan::call('db:seed', array('--class' => 'userCurrencySubscriptionsWithInitData'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_currency_subscriptions');
    }
};
