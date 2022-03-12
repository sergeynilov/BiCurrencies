<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Currency;
use App\Models\CurrencyHistory;
use App\Http\Resources\CurrencyHistoryResource;


class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'name'           => $this->name,
            'num_code'           => $this->num_code,
            'char_code'           => $this->char_code,
            'bgcolor'           => $this->bgcolor,
            'color'           => $this->color,
            'is_top'           => $this->is_top,
            'active'           => $this->active,
            'ordering'           => $this->ordering,

            'currency_histories_count' => $this->when( isset($this->currency_histories_count), $this->currency_histories_count),
            'latest_currency_history'    => new CurrencyHistoryResource($this->whenLoaded('latest_currency_history')),
            'created_at'           => $this->created_at,
            'created_at_formatted' => \App\Library\Services\DateFunctionality::getFormattedDateTime($this->created_at),
            'updated_at'           => $this->updated_at,
            'updated_at_formatted' => \App\Library\Services\DateFunctionality::getFormattedDateTime($this->updated_at),
        ];
    }

    public function with($request)
    {
        return [
            'meta' => [
                'version' => getAppVersion()
            ]
        ];
    }

}

