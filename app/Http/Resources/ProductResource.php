<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name"          => $this->name,
            "code"          => $this->code,
            "price"         => $this->price,
            "amount"        => $this->amount,
            "brand"         => $this->brand,
            "updated_at"    => $this->updated_at,
            "created_at"    => $this->created_at,
        ];
    }
}
