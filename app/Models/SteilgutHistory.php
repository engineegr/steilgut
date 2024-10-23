<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SteilgutHistory extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'thread'];

    protected $table = 'steilgut_history';
    
    protected $fillable = ['title', 'year', 'thread'];
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
