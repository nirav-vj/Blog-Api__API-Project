<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'title' => $this->title,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'tag_id' => $this->tag_id,
            'tag_name' => $this->tag->name,
            'categori_id'=>$this->categori_id,
            'categori_name'=>$this->categori->name,
            'status'=>$this->status,
            'date'=>$this->date,
        ];
    }
}