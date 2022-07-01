<?php

namespace App\Http\Resources\Theme;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'place'         => $this->place,
            'location'      => $this->location,
            'image'         => $this->image,
            'status'        => $this->status,
            'date_start'    => date('Y-m-d', strtotime($this->date_start)),
            'time_start'    => date('H:i:s', strtotime($this->time_start)),
            'date_end'      => date('Y-m-d', strtotime($this->date_end)),
            'time_end'      => date('H:i:s', strtotime($this->time_end)),
            'participants'  => $this->participants,
            'visibility'    => $this->visibility
        ];
    }
}
