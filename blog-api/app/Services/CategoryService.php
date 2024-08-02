<?php

namespace App\Services;

use App\CommonInterface;
use App\Exceptions\NotFoundMessage;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CommonInterface {

    public function getAll(){
        return Cache::remember('_all_categories', now()->addMinutes(10), function(){
            return Category::visible()->get();
        });
    }


    public function getBySlug($slug)
    {
        $categories = Category::with(['posts' => function ($query){
            $query->visible();
        }])
        ->where('slug', $slug)
        ->visible()
        ->first();

        if(!$categories){
            throw new NotFoundMessage('category');
        }
        return $categories;
    }


}
