<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService{

    public function getAllCategory(){
        return Cache::remember('_all_categories', now()->addMinutes(10), function(){
            return Category::visible()->get();
        });
    }







}
