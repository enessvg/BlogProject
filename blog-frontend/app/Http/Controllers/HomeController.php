<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    private $apiUrl;
    public function __construct() {
        $this->apiUrl = config('services.api_url');
    }
    public function index() {

        $allPostsResponse = Http::get($this->apiUrl.'api/post');
        $allPosts = $allPostsResponse->json()['data']['post'];

        $popularPostsResponse = Http::get($this->apiUrl.'api/popular-post');
        $popularPosts = $popularPostsResponse->json()['data']['post'];

        return view('home', [
            'allPosts' => $allPosts,
            'popularPosts' => $popularPosts,
        ]);
    }

    public function singleCategory($slug){

        $response = Http::get($this->apiUrl."api/category/{$slug}");

        if ($response->json()['status'] === false) {
            // Kategori bulunamadıysa 404 sayfasına yönlendir
            abort(404, 'The category you are trying to view was not found!');
        }

        $categorie = $response->json()['data']['categories'];

        $CategoryPost = $response->json()['data']['posts'];

        return view('category', ['categorie' => $categorie, 'categoryPost' => $CategoryPost]);
    }

    public function agreements($slug){
        $response = Http::get($this->apiUrl."api/agreement/{$slug}");

        if ($response->json()['status'] === false) {
            // Kategori bulunamadıysa 404 sayfasına yönlendir
            abort(404, 'The category you are trying to view was not found!');
        }

        $agreements = $response->json()['agreements'];

        return view('site.agreements', ['agreements' => $agreements]);
    }


    // public function commentPost(Request $request){

    //     $validateComment = Validator::make($request->all(),[
    //         'post_id' => 'required',
    //         'name' => 'required',
    //         'email' => 'required|email|min:2',
    //         'content' => 'required|min:3',
    //     ]);

    //     if ($validateComment->fails()) {
    //         return back()
    //         ->withErrors($validateComment)
    //         ->withInput() // mesela post atıyor name kısmını doldurmuş ama diğer yerleri boş bırakmış withInput sayesinde name kısmını koruyarak bidaha yazmamasını sağlıyorum. onuda {{ old('...') }} ile sağlıyorum form üzerinde
    //         ->withFragment('comment-form-section'); //linke # olarak ekliyor ve istediğim yere götürebiliyorum.
    //     }

    //     $response = Http::post($this->apiUrl.'api/comments',[
    //         'post_id' => $request->post_id,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'content' => $request->content,
    //     ]);

    //     if($response->successful()) {
    //         return back()->withFragment('comment-form-section')->withErrors(['commentSuccess' => 'Your comment has been submitted. It will appear when the administrator approves it.']);
    //     } else {
    //         return back()->withFragment('comment-form-section')->withErrors(['commentError' => 'Your comment could not be sent. Try again later']);
    //     }
    // }

    // public function commentGet() {
    //     //kendimce sayfayı korumak amaçlı yaptım.
    //     $url = config('services.site_url');
    //     return redirect($url);
    // }


}
