<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminPostsListResource extends JsonResource
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
            'status' => $this->status,
            'type' => $this->type,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d.m.Y'),
            'user' => UserResource::make($this->user),
        ];
    }
}
