<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Currency;

class CurrencyCollection extends ResourceCollection
{
    public static $wrap = 'currency';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collecRRRtResource($this->collection)->transform(static function (Currency $currency){
            $filenameData = [];
//            if(!empty($currency->id)) {
//                $filenameData = Currency::setCurrencyImageProps($currency->id, $currency->image, true);
//            }
            /*         Schema::create('currency', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();

            $table->string('name', 100)->unique();
            $table->string('num_code', 3)->unique();
            $table->string('char_code', 3)->unique();

            $table->string('color', 7)->nullable();
            $table->string('bgcolor', 7)->nullable();

            $table->boolean('is_top')->default(false);
            $table->boolean('active')->default(false);
            $table->integer('ordering')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index(['created_at'], 'currency_created_at_index');
            $table->index(['active', 'char_code', 'is_top'], 'currencies_id_active_char_code_creator_index');
            $table->index(['ordering', 'active'], 'currencies_ordering_active_index');

                    (
            [0] => Array
                (
                    [id] => 5
                    [name] => Danish krone
                    [num_code] => 208
                    [char_code] => DKK
                    [color] => #ffffff
                    [bgcolor] => #DC3545
                    [is_top] => 0
                    [active] => 1
                    [ordering] => 14
                    [created_at] => 2022-03-06 14:55:34
                    [updated_at] =>
                    [currency_histories_count] => 13
                    [latest_currency_history] => Array
                        (
                            [id] => 401
                            [day] => 2021-03-08
                            [currency_id] => 5
                            [nominal] => 1
                            [value] => 4.9052110818
                            [created_at] => 2021-03-08 15:50:53
                        )

                )
        });
        Artisan::call('db:seed', array('--class' => 'CurrencyWithInitData'));
 */
            return [
                'id' => $currency->id,
                'name' => $currency->name,
                'num_code' => $currency->num_code,
                'char_code' => $currency->char_code,
                'color' => $currency->color,
                'bgcolor' => $currency->bgcolor,
                'is_top' => $currency->is_top,
                'active' => $currency->active,
                'ordering' => $currency->ordering,
                'created_at' => $currency->created_at,
                'updated_at' => $currency->updated_at,

//                'currency_histories_count'    => $currency->currency_histories_count ?? null,
                'currency_histories_count' => $this->when( isset($currency->currency_histories_count), $currency->currency_histories_count),

//                CurrencyHistoryResource
                //                'latest_currency_history'    => $currency->whenLoaded('latest_currency_history'),
            ];
        });
    }

    public function with($skill)
    {
        return [
            'meta' => [
                'version'=>getAppVersion()
            ]
        ];
    }
}
