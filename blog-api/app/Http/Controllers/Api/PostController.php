<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Comments;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(){
        $posts = $this->postService->getAllPosts();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => PostResource::collection($posts),
        ], 200);
    }

    public function popularPost()
    {
        $posts = $this->postService->getPopularPosts();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => PostResource::collection($posts),
        ], 200);
    }


    public function show($slug)
    {
        $data = $this->postService->getPostBySlug($slug);

        return response()->json([
            'status' => true,
            'message' => 'Post found',
            'post' => $data['post'],
            'comments' => $data['comments'],
        ], 200);
    }

}
