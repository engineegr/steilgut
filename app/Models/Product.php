<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['total_in_stock', 'discount'];

    public function productable()
    {
        return $this->morphTo();
    }

    public function orders()
    {
        /*
         * Link: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
         * To determine the table name of the relationship's intermediate table, 
         * Eloquent will join the two related model names in alphabetical order. 
         * However, you are free to override this convention.
        */
        return $this->belongsToMany(OrderData::class, 'orders');
    }

    public function getPrice()
    {
        $price = $this->productable->price;
        if ($this->discount !== 0.0) {
            $price = round($price * $this->discount);
        }

        return $price;
    }

    public function getNumericDiscount()
    {
        return $this->discount * 100;
    }

    public function getFormatDiscountPrice()
    {
        return number_format($this->productable->price * (1 - $this->discount), 1, ',');
    }

    public function scopeWineProducts($queryBuilder)
    {
        return $queryBuilder->where('total_in_stock', '>',  0)->with('productable')->get()->where('productable_type', '=', 'App\Models\Wine');
    }

    public function scopeRangeWineProducts($queryBuilder, $startNum, $endNum)
    {
        return $queryBuilder->where('total_in_stock', '>',  0)
            ->with('productable')->offset($startNum - 1)
            ->limit($endNum - $startNum + 1)
            ->where('productable_type', '=', 'App\Models\Wine')
            ->get();
    }

    public function scopeWineProductCount($queryBuilder)
    {
        return $queryBuilder
            ->where('total_in_stock', '>',  0)
            ->where('productable_type', '=', 'App\Models\Wine')
            ->orWhere('productable_type', '=', 'App\Models\WineSet')
            ->get()
            ->count();
    }

    public function scopeFilterRangeWineProducts(Builder $qb, $startNum, $endNum, $filters)
    {
        $qb->where('total_in_stock', '>',  0)
            ->whereHasMorph('productable', \App\Models\Wine::class, function (&$nestedQb) use ($filters) {
                foreach ($filters as $attr => $value) {
                    if (is_string($value)) {
                        $locale = App::getLocale();
                        $nestedQb->where("{$attr}->{$locale}", $value);
                    } else {
                        $nestedQb->where($attr, '=', $value);
                    }
                }
            })->offset($startNum - 1)->limit($endNum - $startNum + 1)->with('productable');

        return $qb;
    }

    public function scopeFilterWineProductsCount(Builder $qb, $filters)
    {
        $qb->where('total_in_stock', '>',  0)
            ->whereHasMorph(
                'productable',
                \App\Models\Wine::class,
                function (&$nestedQb) use ($filters) {
                    foreach ($filters as $attr => $value) {
                        if (is_string($value)) {
                            $locale = App::getLocale();
                            $nestedQb->where("{$attr}->{$locale}", $value);
                        } else {
                            $nestedQb->where($attr, '=', $value);
                        }
                    }
                }
            );

        return $qb->count();
    }

    public function scopeFilterCartWineProductList(Builder $qb, $cartIds)
    {
        $qb->whereIn('id', $cartIds)->where('productable_type', '=', 'App\Models\Wine')
            ->where('total_in_stock', '>',  0);
    }

    /* WineSet */
    public function scopeWineSetProducts($queryBuilder)
    {
        return $queryBuilder->where('total_in_stock', '>',  0)->with('productable')->get()->where('productable_type', '=', 'App\Models\WineSet');
    }

    public function scopeWineSetProductCount($queryBuilder)
    {
        return $queryBuilder->get()->where('total_in_stock', '>',  0)->where('productable_type', '=', 'App\Models\WineSet')->count();
    }

    public function scopeRangeWineSetProducts($queryBuilder, $startNum, $endNum)
    {
        return $queryBuilder->with('productable')->offset($startNum - 1)
            ->limit($endNum - $startNum + 1)
            ->where('total_in_stock', '>',  0)
            ->where('productable_type', '=', 'App\Models\WineSet')
            ->get();
    }

    public function scopeFilterRangeWineSetProducts(Builder $qb, $startNum, $endNum, $filters)
    {
        $qb->where('total_in_stock', '>',  0)
            ->whereHasMorph(
                'productable',
                \App\Models\WineSet::class,
                function (&$nestedQb) use ($filters) {
                    foreach ($filters as $attr => $value) {
                        $this->filterWineSet($nestedQb, $attr, $value);
                    }
                }
            )->offset($startNum - 1)->limit($endNum - $startNum + 1)->with('productable');

        return $qb;
    }

    public function scopeFilterWineSetProductsCount(Builder $qb, $filters)
    {
        $qb->where('total_in_stock', '>',  0)
            ->whereHasMorph(
                'productable',
                \App\Models\WineSet::class,
                function (&$nestedQb) use ($filters) {
                    foreach ($filters as $attr => $value) {
                        $this->filterWineSet($nestedQb, $attr, $value);
                    }
                }
            );

        return $qb->count();
    }

    public function scopeFilterCartWineSetProductList(Builder $qb, $cartIds)
    {
        $qb->where('total_in_stock', '>',  0)
            ->whereIn('id', $cartIds)
            ->where('productable_type', '=', 'App\Models\WineSet');
    }

    private function filterWineSet(Builder $nestedQb, $attr, $value)
    {
        if ($attr === 'harvest') {
            $nestedQb->where('min_harvest', '<=', $value)->where('max_harvest', '>=', $value);
        } else if (in_array($attr, WineSet::getColumnListing('wine_set'))) {
            if (is_string($value)) {
                $locale = App::getLocale();
                $nestedQb->where("{$attr}->{$locale}", $value);
            } else {
                $nestedQb->where($attr, '=', $value);
            }
        }
        return $nestedQb;
    }
}
