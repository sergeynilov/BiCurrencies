<?php

namespace App\Http\Resources;

//use App\Models\Notification as NotificationModel;
use App\Library\Services\DateFunctionality;
use App;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\JsonResource as UserResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $dateFunctionality= App::make(DateFunctionality::class);
//        \Log::info(  varDump( $this, ' -100 $this::') );
        $data_text= '';
        if(!empty($this->data)) {
//            \Log::info(  varDump( $this->data, ' -1 $this->data::') );
            foreach ($this->data as $next_key => $next_value) {
                if (is_array($next_value)) {
                    $next_value = print_r(is_array($next_value));
                }
                $data_text .= $next_key . ' = ' . $next_value . '<br> ';
            }
        }
        return [
//            'id' => !empty($this->id) ? $this->id : $this['id'],
            'id' => $this->id,
            'type' => $this->type,
            'notifiable_type' => convertNotificationIntoLabel($this->type, 'type'),
            'notifiable_id' => $this->notifiable_id,
//            'data' => $this->data,
            'data' => trimRightSubString(trim($data_text), ', ') ,
            'read_at' => $this->read_at,
            'read_at_formatted' => $dateFunctionality->getFormattedDateTime($this->read_at),
            'created_at' => $this->created_at,
            'created_at_formatted' => $dateFunctionality->getFormattedDateTime($this->created_at),
            'updated_at' => $this->updated_at,
            'updated_at_formatted' => $dateFunctionality->getFormattedDateTime($this->updated_at),
        ];
    }
}


