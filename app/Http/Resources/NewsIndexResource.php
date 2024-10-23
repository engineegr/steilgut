<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Image;

class NewsIndexResource extends JsonResource
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
            'postingDate' => $this->posting_date,
            'title' => $this->title,
            'image' => $this->image,
        ];
    }
}
