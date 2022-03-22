<?php

namespace App\Http\Resources;

//use App\Library\Services\CurrencyRatesFunctionality;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LatestCurrencyHistoryResource;
use App\Library\Services\DateFunctionality;
use App;

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
        $dateFunctionality = App::make(DateFunctionality::class);
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'num_code'  => $this->num_code,
            'char_code' => $this->char_code,
            'bgcolor'   => $this->bgcolor,
            'color'     => $this->color,
            'is_top'    => $this->is_top,
            'active'    => $this->active,
            'ordering'  => $this->ordering,
            'currency_histories_count' => $this->when(isset($this->currency_histories_count),
                $this->currency_histories_count),
            'latest_currency_history'  => new LatestCurrencyHistoryResource($this->whenLoaded('latestCurrencyHistory')),
            'media_image_url'      => $this->media_image_url,
            'created_at'           => $this->created_at,
            'created_at_formatted' => $dateFunctionality->getFormattedDateTime($this->created_at),
            'updated_at'           => $this->updated_at,
            'updated_at_formatted' => $dateFunctionality->getFormattedDateTime($this->updated_at),
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

