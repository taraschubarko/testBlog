<?php

namespace App\Http\Resources;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'notifiable_id' => $this->notifiable_id,
            'data' => $this->data,
            'read_at' => $this->read_at,
            'created_at' => $this->created_at->format('d.m.Y'),
            'sent' => $this->data['sender_id'] == auth()->id() ? true : false,
            'user' => UserResource::make(User::find($this->data['sender_id'])),
        ];
    }
}
