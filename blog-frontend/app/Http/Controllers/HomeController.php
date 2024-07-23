<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index() {
        $allPostsResponse = Http::get('http://localhost:8181/api/post');
        $allPosts = $allPostsResponse->json()['post'];

        $popularPostsResponse = Http::get('http://localhost:8181/api/popular-post');
        $popularPosts = $popularPostsResponse->json()['post'];

        $allCategoryResponse = Http::get('http://localhost:8181/api/category');
        $allCategory = $allCategoryResponse->json()['categories'];

        return view('home', [
            'allPosts' => $allPosts,
            'popularPosts' => $popularPosts,
            'allCategory' => $allCategory,
        ]);
    }

    public function SingleCategory($slug){
        $response = Http::get("http://localhost:8181/api/category/{$slug}");

        if ($response->json()['status'] === false) {
            // Kategori bulunamadıysa 404 sayfasına yönlendir
            abort(404, 'The category you are trying to view was not found!');
        }

        $categorie = $response->json()['categories'];

        $CategoryPost = $response->json()['posts'];

        //bunları navbarda kategoriler kısmında allCategory bulamadığı için yazdım.
        $responseCategory = Http::get('http://localhost:8181/api/category');
        $allCategory = $responseCategory->json()['categories'];

        return view('category', ['categorie' => $categorie, 'categoryPost' => $CategoryPost, 'allCategory' => $allCategory]);
    }


    public function kvkk(){
        $response = Http::get('http://localhost:8181/api/kvkk-aydinlatma-metni');

        $kvkk_text = $response->json()['kvkk'];

        //bunları navbarda kategoriler kısmında allCategory bulamadığı için yazdım.
        $responseCategory = Http::get('http://localhost:8181/api/category');
        $allCategory = $responseCategory->json()['categories'];

        return view('site.kvkk-aydinlatma-metni', ['kvkk' => $kvkk_text, 'allCategory' => $allCategory]);
    }

    public function privacy_policy(){
        $response = Http::get('http://localhost:8181/api/privacy-policy');

        $policy_text = $response->json()['privacy_policy'];

        //bunları navbarda kategoriler kısmında allCategory bulamadığı için yazdım.
        $responseCategory = Http::get('http://localhost:8181/api/category');
        $allCategory = $responseCategory->json()['categories'];

        return view('site.privacy-policy', ['privacy_policy' => $policy_text, 'allCategory' => $allCategory]);
    }

    public function commentPost(Request $request){
        $validateComment = Validator::make($request->all(),[
            'post_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|min:2',
            'content' => 'required|min:3',
        ]);

        if ($validateComment->fails()) {
            return back()
            ->withErrors($validateComment)
            ->withInput() // mesela post atıyor name kısmını doldurmuş ama diğer yerleri boş bırakmış withInput sayesinde name kısmını koruyarak bidaha yazmamasını sağlıyorum. onuda {{ old('...') }} ile sağlıyorum form üzerinde
            ->withFragment('comment-form-section'); //linke # olarak ekliyor ve istediğim yere götürebiliyorum.
        }

        $response = Http::post('http://localhost:8181/api/comments',[
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        if($response->successful()) {
            return back()->withFragment('comment-form-section')->withErrors(['commentSuccess' => 'Your comment has been submitted. It will appear when the administrator approves it.']);
        } else {
            return back()->withFragment('comment-form-section')->withErrors(['commentError' => 'Your comment could not be sent. Try again later']);
        }
    }

    public function commentGet() {
        //kendimce sayfayı korumak amaçlı yaptım.
        $appUrl = 'http://127.0.0.1:8000/';
        return redirect($appUrl);
    }


}
