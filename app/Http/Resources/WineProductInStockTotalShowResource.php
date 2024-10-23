<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WineProductInStockTotalShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'totalInStock' => $this->total_in_stock,
            'discount' => $this->discount,
            'price' => $this->productable->price,
        ];
    }
}
