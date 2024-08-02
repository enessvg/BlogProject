<?php

namespace App\Services;

use App\CommonInterface;
use App\Events\IncreaseView;
use App\Exceptions\NotFoundMessage;
use App\Models\Comments;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Cache;

class PostService implements CommonInterface
{

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll()
    {
        return $this->postRepository->getAll();
    }

    public function getPopularPosts()
    {
        return $this->postRepository->getPopularPosts();
    }

    public function getBySlug($slug)
    {
        return $this->postRepository->getBySlug($slug);
    }

}
