<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendPostController extends Controller
{
    public function show($slug)
    {
        $apiUrl = config('services.api_url');

        $response = Http::get($apiUrl."api/post/detail/{$slug}");

        if ($response->json()['status'] === false) {

            abort(404, 'The post you are trying to view was not found!');

        }
        else if($response->json()['status'] === true){

        $post = $response->json()['data']['post'];

        $comments = $response->json()['data']['comments'];

        return view('post-detail', ['post' => $post, 'comments' => $comments]);
        }


    }
}
