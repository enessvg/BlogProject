<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('is_visible', 1)->get();

        return response()->json([
            'status' => true,
            'Messages' => 'Listing successful',
            'categories'=> $categories,
        ], 200);
    }

    public function show($slug){
        $categories = Category::where('slug', $slug)->where('is_visible', 1)->first();
        if(!$categories){
            return response()->json([
               'status' => false,
               'message' => 'The category you are trying to view was not found!'
            ], 404);
        }

        $post = Post::where('category_id', $categories->id)->where('is_visible', 1)->get();

        return response()->json([
            'status' => true,
            'categories' => $categories,
            'posts' => $post,
        ]);

    }
}
