<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Jobs\SendSuperAdminEmailJob;
use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class CommentController extends Controller
{
    public function index(){
        // $comments = Comments::where('is_visible', 1)->get();
        // return response()->json([
        //     'status' => false,
        //     'message' => '404',
        //     // 'comments' => $comments,
        // ], 200);
        // abort(404);
        throw new NotFoundMessage('comments');
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            // Yeni comment oluşturma
            $comment = new Comments();
            $comment->post_id = $request->post_id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->content = $request->content;
            $comment->save();

            // Başarılı mesajı
            return response()->json([
                'status' => true,
                'message' => 'Comment successfully saved.'], 201);
        } catch (\Exception $e) {
            //Beklenmeyen hataları yakalamak için
            return response()->json(['message' => 'An error occurred while trying to save the comment!', 'error' => $e->getMessage()], 500);
        }
    }
}
