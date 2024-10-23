<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WineProductShowResource extends JsonResource
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
            'title' => $this->productable->title,
            'harvest' => $this->productable->harvest,
            'terroir' => $this->productable->terroir,
            'wineType' => $this->productable->wineType,
            'price' => $this->productable->price,
            'formatPrice' => $this->productable->getFormatPrice(),
            'formatDiscountPrice' => $this->getFormatDiscountPrice(),
            'discount' => $this->discount,
            'color' => $this->productable->color,
            'totalInStock' => $this->total_in_stock,
        ];
    }
}
