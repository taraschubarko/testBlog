<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPostEditResource extends JsonResource
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
            'status' => $this->status,
            'image_files' => [],
            'note' => [
                'text' => $this->note ? $this->note->text : null
            ],
        ];
    }
}
