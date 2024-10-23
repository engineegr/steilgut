<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WineSetProductShowResource extends JsonResource
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
            'minHarvest' => $this->productable->minHarvest,
            'maxHarvest' => $this->productable->maxHarvest,
            'count' => $this->productable->count,
            'terroir' => $this->productable->terroir,
            'price' => $this->productable->price,
            'formatPrice' => $this->productable->getFormatPrice(),
            'formatDiscountPrice' => $this->getFormatDiscountPrice(),
            'discount' => $this->discount,
            'totalInStock' => $this->total_in_stock,
            'tooltip' => [
                'announcement' => $this->productable->tooltip->announcement,
                'image' => $this->productable->tooltip->image,
            ],
        ];
    }
}
