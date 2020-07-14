<?php

namespace AhmdSwerky\Media\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaSimpleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'model' => $this->mediable_type,
            'type' => $this->type,
            'path' => $this->displayedPath,
            'name' => $this->name,
            'title' => $this->title,
            // 'description' => $this->description,
            // 'notes' => $this->notes,
        ];
    }
}