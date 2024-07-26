<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id', 'desc')//en son ki yazı başa gelmesi için böyle yaptım.
        ->visible()
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => $posts,
        ], 200);
    }

    public function popularPost()
    {
        $posts = Post::orderBy('post_views', 'desc')
        ->visible()
        ->limit(config('settings.popular_limit'))
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => $posts,
        ], 200);
    }


    public function show($slug){
        // Post'u slug ile bul
        $post = Post::where('slug', $slug)->visible()->first();

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'The post you are trying to view was not found!'
            ], 404);
        }

        //comment tablosundaki yorumlarda post_id'si uyuşuyorsa ve görünür haldeyse onları çağırıyorum.
        $comments = Comments::where('post_id', $post->id)
        ->where('is_visible', 1)
        ->get();


        // Bağlantılı tabloları dahil etmek için category_id sine göre categories tablosunda bulup onun ismini yazdırıyor user_id içinde aynı şekilde.
        $postArray = $post->toArray();
        $postArray['category_id'] = $post->category->name;
        $postArray['user_id'] = $post->user->name;

        return response()->json([
            'status' => true,
            'message' => 'Post found',
            'post' => $postArray,
            'comments' => $comments
        ], 200);
    }


}
