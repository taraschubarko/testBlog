<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMessageResource extends JsonResource
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
            'message' => $this->data['message'],
            'user' => UserResource::make(User::find($this->data['sender_id'])),
            'read_at' => $this->read_at,
            'created_at' => $this->created_at->format('d.m.Y в H:i'),
        ];
    }
}
