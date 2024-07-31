<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(){
        $categories = $this->categoryService->getAllCategory();

        return response()->json([
            'status' => true,
            'Messages' => 'Listing successful',
            'categories'=> CategoryResource::collection($categories),
        ], 200);
    }

    public function show($slug){
        $categories = Category::where('slug', $slug)->visible()->first();
        if(!$categories){
            throw new NotFoundMessage('category');
        }

        $post = Post::where('category_id', $categories->id)->visible()->get();

        return response()->json([
            'status' => true,
            'categories' => $categories,
            'posts' => PostResource::collection($post),
        ]);

    }
}
