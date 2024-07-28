<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'is_visible'];

    public function scopeVisible(Builder $query)
    {
        return $query->where('is_visible', 1);
    }

    protected static function boot(){

        parent::boot();

        static::saved(function(){
            Cache::forget('_all_categories');
        });
    }
}
