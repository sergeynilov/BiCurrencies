<?php

namespace App\Http\Resources;

use App\Models\CurrencyHistory as CurrencyHistoryModel;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\JsonResource as UserResource;

class CurrencyHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        \Log::info(  varDump($request, ' -1 CurrencyHistoryResource  $request::') );
//        \Log::info(  varDump($this, ' -1 CurrencyHistoryResource  $this::') );
        /*                    [latest_currency_history] => Array
                        (
                            [id] => 401
                            [day] => 2021-03-08
                            [currency_id] => 5
                            [nominal] => 1
                            [value] => 4.9052110818
                            [created_at] => 2021-03-08 15:50:53
                        )
 */
        return [
            'id' => $this->id,
            'day' => $this->day,
            'day_label' => \App\Library\Services\DateFunctionality::getFormattedDate($this->day),
            'currency_id' => $this->currency_id,
            'nominal' => $this->nominal,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'created_at_formatted' => \App\Library\Services\DateFunctionality::getFormattedDateTime($this->created_at),
        ];
    }
}

