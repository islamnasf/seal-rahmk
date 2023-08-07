<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class postResource extends JsonResource
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
            'id'=>$this->id,
            'username'=>$this->users->name,
           // 'username'=>$this->users->id,
            'content'=>$this->content,
            'image'=>$this->image,
            'comments'=>commentResource::collection($this->comments),
            'likes'=>likeResource::collection($this->likes)
        ];    
    }
}
