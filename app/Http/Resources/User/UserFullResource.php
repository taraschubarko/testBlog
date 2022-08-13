<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
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
            'slug' => $this->slug,
            'birthday' => Carbon::parse($this->birthday)->format('d.m.Y'),
            'gender' => [
                'label' => config('user.gender')[$this->gender],
                'value' => $this->gender,
            ],
            'country' => $this->country,
            'city' => $this->city,
            'first_letter' => mb_substr($this->name, 0, 1)
        ];
    }
}
