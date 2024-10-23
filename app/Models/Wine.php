<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\ModelMetadataService;
use Illuminate\Support\Facades\App;
use App\Traits\PriceModelService;

class Wine extends Model
{
    use HasFactory, HasTranslations, ModelMetadataService, PriceModelService;

    public $translatable = ['title', 'wineSort', 'wineType', 'soil', 'terroir', 'area', 'harvest_aspect', 'taste', 'color'];

    protected $fillable = ['title', 'harvest', 'image', 'wineSort', 'wineType', 'soil', 'terroir', 'area', 'harvest_aspect', 'taste', 'color', 'price', 'residual_sugar', 'acidity', 'strength', 'order'];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function backgroundImage()
    {
        return $this->morphOne(BackgroundImage::class, 'imageable');
    }

    public function scopeColorList($queryBuilder)
    {
        return $queryBuilder->select('color')->groupBy('color')->pluck('color')->all();
    }

    public function scopeFindOrFailWithBackgroundImage($queryBuilder, $id)
    {
        return $queryBuilder->with('backgroundImage')->with('product')->findOrFail($id);
    }

    public function scopeRangeWineListWithBackgroundImage($queryBuilder, $startNum, $endNum)
    {
        return $queryBuilder->orderBy('harvest')->offset($startNum - 1)->limit($endNum - $startNum + 1)->with('backgroundImage');
    }

    public function scopeRangeWineList($queryBuilder, $startNum, $endNum)
    {
        return $queryBuilder->orderBy('harvest')->orderBy('title', 'desc')->offset($startNum - 1)->limit($endNum - $startNum + 1);
    }

    public function scopeHarvestRangeWineList($queryBuilder, $startNum, $endNum, $harvest)
    {
        return $queryBuilder->where('harvest', $harvest)->orderBy('title', 'desc')->offset($startNum - 1)->limit($endNum - $startNum + 1);
    }

    public function scopeTitleRangeWineList($queryBuilder, $startNum, $endNum, $title)
    {
        $locale = App::getLocale();

        // return $queryBuilder->where("title->{$locale}", $title)->orderBy('harvest', 'asc')->offset($startNum - 1)->limit($endNum - $startNum + 1);
        return $queryBuilder->where("title->{$locale}", $title)->whereHas(
            'product',
            function ($query) {
                $query->where('total_in_stock', '>',  0);
            }
        )->orderBy('harvest', 'asc')->offset($startNum - 1)->limit($endNum - $startNum + 1);
    }

    public function scopeTitleWineList($queryBuilder, $title)
    {
        $locale = App::getLocale();

        // return $queryBuilder->where("title->{$locale}", $title)->orderBy('harvest', 'asc')->offset($startNum - 1)->limit($endNum - $startNum + 1);
        return $queryBuilder->where("title->{$locale}", $title)->whereHas(
            'product',
            function ($query) {
                $query->where('total_in_stock', '>',  0);
            }
        )->orderBy('harvest', 'asc');
    }

    public function scopeWineCountByTitle($queryBuilder, $title)
    {
        $locale = App::getLocale();
        return $queryBuilder->where("title->{$locale}", $title)->distinct()->count();
    }

    public function scopeWineCountByTitleAndHarvest($queryBuilder, $title, $harvest)
    {
        $locale = App::getLocale();
        return $queryBuilder->where("title->{$locale}", $title)->where('harvest', $harvest)->distinct()->count();
    }

    public function scopePosAttributesByHarvest($queryBuilder, $harvest, $pos, $num, $attribute)
    {
        return $queryBuilder->where('harvest', $harvest)->orderBy('title', 'desc')->skip($pos)->take($num)->pluck($attribute);
    }

    public function scopePosAttributes($queryBuilder, $pos, $num, $attribute)
    {
        return $queryBuilder->orderBy('harvest', 'asc')->skip($pos)->take($num)->pluck($attribute);
    }

    public function scopeBottleVolumeList($queryBuilder)
    {
        return $queryBuilder->select('volume')->groupBy('volume')->pluck('volume')->all();
    }

    public function scopeHarvestList($queryBuilder)
    {
        return $queryBuilder->select('harvest')->groupBy('harvest')->pluck('harvest')->all();
    }

    public function scopeTitleList($queryBuilder)
    {
        return $queryBuilder->select('title', 'order')->orderBy('order', 'asc')->distinct()->pluck('title')->all();
    }

    public function scopeHeaderList($queryBuilder)
    {
        return $queryBuilder->select('id', 'title', 'image', 'order')->orderBy('order', 'asc')->distinct();
    }

    public function scopeHarvestWineCount($queryBuilder, $harvest)
    {
        return $queryBuilder->where('harvest', $harvest)->count();
    }

    public function scopeTitleWineCount($queryBuilder, $title)
    {
        $locale = App::getLocale();

        return $queryBuilder->where("title->{$locale}", $title)->whereHas(
            'product',
            function ($query) {
                $query->where('total_in_stock', '>',  0);
            }
        )->count();

        // return $queryBuilder->where("title->{$locale}", $title)->count();
    }

    public function scopeSortList($queryBuilder)
    {
        return $queryBuilder->select('wineSort')->groupBy('wineSort')->pluck('wineSort')->all();
    }

    public function scopeTypeList($queryBuilder)
    {
        return $queryBuilder->select('wineType')->groupBy('wineType')->pluck('wineType')->all();
    }

    public function scopeColumnListing($queryBuilder)
    {
        return \DB::getSchemaBuilder()->getColumnListing($this->getTable());;
    }

    public function scopeTitleCount($queryBuilder)
    {
        return $queryBuilder->select('title')->distinct()->get()->count();
    }

    public function scopeRangeHeaderList($queryBuilder, $pos, $num)
    {
        return $queryBuilder->select('title', 'image', 'terroir')->distinct()->skip($pos)->take($num)->orderBy('title', 'desc');
    }

    public function scopeHarvestListByTitle($queryBuilder, $title, $locale)
    {
        return $queryBuilder->select('harvest')->where("title->{$locale}", $title)->orderBy('harvest');
    }

    public function scopeTitleListByHarvest($queryBuilder, $harvest)
    {
        return $queryBuilder->select('id', 'title')->where('harvest', $harvest)->orderBy('title', 'desc');
    }

    public function scopeGetLastByOrder($queryBuilder)
    {
        return $queryBuilder->orderBy('order', 'desc')->first();
    }

    public function scopeGetFirstByOrder($queryBuilder)
    {
        return $queryBuilder->orderBy('order', 'asc')->first();
    }

    public function shippedOrderReport1stColumn() 
    {
        return $this->harvest . " " . $this->terroir;
    }

    public function getFormatHarvest()
    {
        return $this->harvest;
    }
}
