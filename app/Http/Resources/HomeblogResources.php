<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeblogResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
          return [
            'id'=>$this->id,
            'title' => $this->title,
            'user_name' => $this->user->name,    
            'categori_name'=>$this->categori->name,
            'date'=>$this->date,
        ];
    }
}