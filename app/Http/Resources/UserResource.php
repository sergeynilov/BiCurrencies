<?php

namespace App\Http\Resources;

use App\Library\Services\DateFunctionality;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App;

class UserResource extends JsonResource
{
    public static $wrap = 'users';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $dateFunctionality= App::make(DateFunctionality::class);
//        \Log::info(  varDump($this, ' -1 $this::') );
//        \Log::info(  varDump($this->status, ' -1 $this->status::') );
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'email'                => $this->email,
            'email_verified_at'    => $this->email_verified_at,
            'current_team_id'      => $this->current_team_id,
            'status'               => $this->status,
            'status_label'         => \App\Models\User::getUserStatusLabel($this->status),

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

