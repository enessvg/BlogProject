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
        ->where('is_visible', 1)
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => $posts,
        ], 200);
    }

    public function populerPost()
    {
        $posts = Post::orderBy('post_views', 'desc')
        ->where('is_visible', 1)
        ->limit(8)
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => $posts,
        ], 200);
    }


    public function show($slug){
        // Post'u slug ile bul
        $post = Post::where('slug', $slug)->where('is_visible', 1)->first();

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'The post you are trying to view was not found!'
            ], 404);
        }

        //Görüntülemeyi arttırmak için(To increase viewing)
        $post->post_views += 1;
        $post->save();

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
