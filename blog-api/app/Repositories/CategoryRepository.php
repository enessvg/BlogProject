<?php

namespace App\Repositories;

use App\CommonInterface;
use App\Exceptions\NotFoundMessage;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CommonInterface
{
    public function getAll()
    {
        return Cache::remember('_all_categories', now()->addMinutes(10), function () {
            return Category::visible()->get();
        });
    }

    public function getBySlug($slug)
    {
        $category = Category::with(['posts' => function ($query) {
            $query->visible();
        }])
        ->where('slug', $slug)
        ->visible()
        ->first();

        if (!$category) {
            throw new NotFoundMessage('category');
        }

        return $category;
    }
}
