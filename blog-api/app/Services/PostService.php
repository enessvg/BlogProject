<?php

namespace App\Services;

use App\CommonInterface;
use App\Events\IncreaseView;
use App\Exceptions\NotFoundMessage;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostService implements CommonInterface
{

    public function getAll()
    {
        return Cache::remember('_all_posts', now()->addMinutes(10), function () {
            return Post::orderBy('id', 'desc') //en son ki yazı başa gelmesi için böyle yaptım.
                ->visible()
                ->get();
        });
    }


    public function getPopularPosts(){
        return Cache::remember('_popular_post', now()->addMinutes(10), function(){
            return Post::orderBy('post_views', 'desc')
            ->visible()
            ->limit(config('settings.popular_limit'))
            ->get();
        });
    }

    // public function increaseView($post){
    //     $post->increment('post_views');
    // }

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

        // $comments = Comments::where('post_id', $post->id)
        //     ->where('is_visible', 1)
        //     ->get();

        // $this->increaseView($post);
        event(new IncreaseView($post));

        return [
        'post' => $post,
        'comments' => $post->comments,
        ];
    }

}
