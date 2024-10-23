<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SteilgutHistoryIndexResource extends JsonResource
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
            'year' => $this->year,

            'xsImage' => $this->xs_image,
            'xs2xImage' => $this->xs_2x_image,

            'smImage' => $this->sm_image,
            'sm2xImage' => $this->sm_2x_image,

            'mdImage' => $this->md_image,
            'md2xImage' => $this->md_2x_image,

            'lgImage' => $this->lg_image,
            'lg2xImage' => $this->lg_2x_image,

            'hdImage' => $this->hd_image,
            'hd2xImage' => $this->hd_2x_image,

            'title' => $this->title,

            'thread' => $this->thread,
        ];
    }
}
