<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static $CATEGORY_DICT = [
        [
            'dict_name' => 'NEWS_CATEGORY',
            'name' => 'News',
            'url' => 'news',
        ],
        [
            'dict_name' => 'WINE_CATEGORY',
            'name' => 'Wines',
            'url' => 'wines',
        ],
        [
            'dict_name' =>  'STEILGUT_HISTORY_CATEGORY',
            'name' => 'Steilgut history',
            'url' => 'steilgut_history',
        ],
        [
            'dict_name' => 'ORDER_CATEGORY',
            'name' => 'Orders',
            'url' => 'orders',
        ],
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function steilgutHistory()
    {
        return $this->hasMany(SteilgutHistory::class);
    }

    public function scopeCategoryDictItems($query)
    {
        return $query->select('name', 'dict_name', 'url')->orderBy('name', 'asc')->get();
    }

    public function scopeNewsCategoryDictItem($query)
    {
        return $query->where('dict_name', self::$CATEGORY_DICT[0]['dict_name'])->get()->first();
    }

    public function scopeWineCategoryDictItem($query)
    {
        return $query->where('dict_name', self::$CATEGORY_DICT[1]['dict_name'])->get()->first();
    }

    public function scopeSteilgutHistoryCategoryDictItem($query)
    {
        return $query->where('dict_name', self::$CATEGORY_DICT[2]['dict_name'])->get()->first();
    }

    public function scopeOrderCategoryDictItem($query)
    {
        return $query->where('dict_name', self::$CATEGORY_DICT[3]['dict_name'])->get()->first();
    }
}
