<?php

namespace App\Http\Resources;

//use App\Library\Services\CMSItemRatesFunctionality;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Library\Services\DateFunctionality;
use App;

class CMSItemResource extends JsonResource
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
            'id'              => $this->id,
            'title'           => $this->title,
            'key'             => $this->key,
            'text'            => $this->text,
            'author_id'       => $this->author_id,
            'author'          => new UserResource($this->whenLoaded('author')),
            'media_image_url' => $this->media_image_url,

            'published'            => $this->published,
            'published_formatted'  => $dateFunctionality->getFormattedDateTime($this->published),
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

