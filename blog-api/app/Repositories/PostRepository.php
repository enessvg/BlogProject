<?php

namespace App\Repositories;

use App\CommonInterface;
use App\Events\IncreaseView;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\NotFoundMessage;

class PostRepository implements CommonInterface
{
    public function getAll()
    {
        return Cache::remember('_all_posts', now()->addMinutes(10), function () {
            return Post::orderBy('id', 'desc')
                ->visible()
                ->get();
        });
    }

    public function getPopularPosts()
    {
        return Cache::remember('_popular_post', now()->addMinutes(10), function () {
            return Post::orderBy('post_views', 'desc')
                ->visible()
                ->limit(config('settings.popular_limit'))
                ->get();
        });
    }

    public function getBySlug($slug)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->where('is_visible', 1);
        }])
        ->where('slug', $slug)
        ->visible()
        ->first();

        if (!$post) {
            throw new NotFoundMessage('post');
        }

        event(new IncreaseView($post));

        return [
            'post' => $post,
            'comments' => $post->comments,
        ];
    }
}
