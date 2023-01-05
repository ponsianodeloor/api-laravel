<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'extract' => $this->extract,
            'status_number' => $this->status,
            'status' => $this->status == 1 ? 'Borrador': 'Publicado',
            //'user' => $this->user,
            'user'=> UserResource::make($this->whenLoaded('user'))
        ];
    }
}
