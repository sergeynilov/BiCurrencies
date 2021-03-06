<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();

            $table->string('name', 100)->unique();
            $table->string('num_code', 3)->unique();
            $table->string('char_code', 3)->unique();
            $table->mediumText('description')->nullable();

            $table->string('color', 7)->nullable();
            $table->string('bgcolor', 7)->nullable();

            $table->boolean('is_top')->default(false);
            $table->boolean('active')->default(false);
            $table->smallInteger('ordering')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index(['created_at'], 'currency_created_at_index');
            $table->index(['active', 'char_code', 'is_top'], 'currencies_id_active_char_code_creator_index');
            $table->index(['ordering', 'active'], 'currencies_ordering_active_index');

        });
        Artisan::call('db:seed', array('--class' => 'CurrencyWithInitData'));
        Artisan::call('db:seed', array('--class' => 'currencyMediaWithInitData'));


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
