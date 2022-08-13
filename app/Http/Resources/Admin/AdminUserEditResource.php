<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserEditResource extends JsonResource
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
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'country' => $this->country,
            'city' => $this->city,
            'status' => $this->status,
            'roles' => $this->roles->pluck('id')->toArray(),
            'password' => null,
        ];
    }
}
