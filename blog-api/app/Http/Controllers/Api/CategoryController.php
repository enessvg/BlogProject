<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\CategoryService;
use App\Traits\ApiResponserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    use ApiResponserTrait;

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(){
        $categories = $this->categoryService->getAll();

        return $this->successResponse([
            'categories'=> CategoryResource::collection($categories),
        ], 'Successfully listed all categories');
    }

    public function show($slug){
        $categories = $this->categoryService->getBySlug($slug);
        //$post = Post::where('category_id', $categories->id)->visible()->get();
        return $this->successResponse([
            'categories' => new CategoryResource($categories), //tekil olduğu için burada "new CategoryResource" olarak kullanıyorum.(object)
            'posts' => PostResource::collection($categories->posts), //burada çoğul olduğu için koleksiyon "PostResource::collection" olarak kullanıyorum. (array)
        ], 'Listing successful');

    }
}
