<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPostResource extends JsonResource
{
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            //'post' => $this->posts
            //'post' => $this->whenLoaded('posts')
            'post' => PostResource::collection($this->whenLoaded('posts'))
        ];
    }
}
