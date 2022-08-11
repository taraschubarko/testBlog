<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'type' => $this->type,
            'created_at' => $this->created_at->format('d.m.Y'),
            'user' => $this->user->only(['id', 'name', 'slug', 'gender']),
            'images' => $this->images->pluck('path'),
        ];
    }
}
