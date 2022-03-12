<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;


class UserResource extends JsonResource
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
            'id'                   => $this->id,
            'name'                 => $this->name,
            'is_admin'             => $this->is_admin,
            'email'                => $this->email,
            'email_verified_at'    => $this->email_verified_at,
            'current_team_id'      => $this->current_team_id,
            'status'               => $this->status,
            'status_label'         => wrpGetUserStatusLabel($this->status),

            //            'user_histories_count' => $this->when( isset($this->user_histories_count), $this->user_histories_count),
            //            'latest_user_history'    => new UserHistoryResource($this->whenLoaded('latest_user_history')),
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

