<?php

namespace App\Http\Resources;

use App\Http\Resources\Theme\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventThemeResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'events'    => EventResource::collection($this->events)
        ];
    }
}
