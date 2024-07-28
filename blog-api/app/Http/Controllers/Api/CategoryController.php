<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(){
        $categories = Cache::remember('_all_categories', now()->addMinutes(10), function(){
            return Category::visible()->get();
        });

        return response()->json([
            'status' => true,
            'Messages' => 'Listing successful',
            'categories'=> $categories,
        ], 200);
    }

    public function show($slug){
        $categories = Category::where('slug', $slug)->visible()->first();
        if(!$categories){
            return response()->json([
               'status' => false,
               'message' => 'The category you are trying to view was not found!'
            ], 404);
        }

        $post = Post::where('category_id', $categories->id)->visible()->get();

        return response()->json([
            'status' => true,
            'categories' => $categories,
            'posts' => $post,
        ]);

    }
}
