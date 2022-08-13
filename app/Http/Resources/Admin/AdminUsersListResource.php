<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUsersListResource extends JsonResource
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
            'email' => $this->email,
            'slug' => $this->slug,
            'birthday' => Carbon::parse($this->birthday)->format('d.m.Y'),
            'gender' => [
                'label' => config('user.gender')[$this->gender],
                'value' => $this->gender,
            ],
            'country' => $this->country,
            'city' => $this->city,
            'status' => [
                'label' => config('user.status')[$this->status],
                'value' => $this->status,
            ],
            'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
