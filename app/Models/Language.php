<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public static $LANGUAGE_DICT = [
        'en', 'ru', 'de', 'zh-CN'
    ];

    public function scopeLanguages($queryBuilder)
    {
        return $queryBuilder->select('lang')->groupBy('lang')->pluck('lang')->all();
    }
}
