<?php

namespace App\Http\Resources;

use App\Library\Services\DateFunctionality;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CurrencyResource;


use App;

class UserCurrencySubscriptionResource extends JsonResource
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
            'id'          => $this->id,
            'user_id'     => $this->user_id,
            'currency_id' => $this->currency_id,
            'currency'    => new CurrencyResource($this->whenLoaded('currency')),
            'created_at'           => $this->created_at,
            'created_at_formatted' => $dateFunctionality->getFormattedDateTime($this->created_at),
        ];
    }
}

