<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Image;

class WinesShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $blob_img = Image::make(public_path() . $this->image)->encode('png');
        // $blob_img_string = "data:image/png;base64," . base64_encode($blob_img);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'wineSort' => $this->wineSort,
            'color' => $this->color,
            'harvest' => $this->harvest,
            'price' => $this->price,
            'formatPrice' => $this->getFormatPrice(),
            'volume' => $this->volume,
            'wineType' => $this->wineType,
            'soil' => $this->soil,
            'terroir' => $this->terroir,
            'age' => $this->age,
            'residualSugar' => $this->residual_sugar,
            'acidity' => $this->acidity,
            'strength' => $this->strength,
            'area' => $this->area,
            'harvestAspect' => $this->harvest_aspect,
            'taste' => $this->taste,
            'image' => $this->image,
            // 'blob_image_string' => $blob_img_string,
            'background_image' => [
                'relative_path' => $this->backgroundImage->relative_path,
                'base_name' => $this->backgroundImage->base_name,
            ],
            'product' => $this->product,
        ];
    }
}
