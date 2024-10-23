<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\ModelMetadataService;
use App\Traits\PriceModelService;

class WineSet extends Model
{
    use HasFactory, HasTranslations, ModelMetadataService, PriceModelService;

    public $translatable = ['title', 'terroir'];

    protected $fillable = ['title', 'terroir', 'min_harvest', 'max_harvest', 'count', 'price', 'image'];

    protected $table = 'wine_set';

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function tooltip()
    {
        return $this->morphOne(Tooltip::class, 'tooltipable');
    }

    public function shippedOrderReport1stColumn() 
    {
        return $this->min_harvest . " - " . $this->max_harvest . " " . $this->terroir;
    }

    public function getFormatHarvest()
    {
        return $this->min_harvest . " - " . $this->max_harvest;
    }
}
