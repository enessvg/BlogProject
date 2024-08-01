<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SinglePostResource;
use App\Models\Comments;
use App\Models\Post;
use App\Services\PostService;
use App\Traits\ApiResponserTrait;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class PostController extends Controller
{

    use ApiResponserTrait;

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(){
        $posts = $this->postService->getAllPosts();

        return $this->successResponse([
            'post' => PostResource::collection($posts),
        ], 'Successful listing of all posts');
    }

    public function popularPost()
    {
        $posts = $this->postService->getPopularPosts();

        return $this->successResponse([
            'post' => PostResource::collection($posts),
        ], 'Successful listing of popular posts');
    }


    public function show($slug)
    {
        $data = $this->postService->getPostBySlug($slug);

        return $this->successResponse([
            'post' => new SinglePostResource($data['post']),
            'comments' => CommentResource::collection($data['comments']),
        ], 'Post found');
    }

}
