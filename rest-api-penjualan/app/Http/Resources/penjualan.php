<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class penjualan extends JsonResource
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
            'id_jadwal' => $this->id_jadwal,
            'id_user' => $this->id_user
        ];
    }
}
