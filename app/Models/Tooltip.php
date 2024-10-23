<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Tooltip extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['announcement'];
    protected $fillable = ['announcement', 'image'];

    public function tooltipable()
    {
        return $this->morphTo();
    }
}
