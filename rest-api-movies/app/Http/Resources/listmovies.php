<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class listmovies extends JsonResource
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
            'judul' => $this->judul,
            'sinopsis' => $this->sinopsis
        ];
    }
}
