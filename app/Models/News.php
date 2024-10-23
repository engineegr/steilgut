<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'posting_date', 'image', 'thread'];
    public $translatable = ['title', 'thread'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
