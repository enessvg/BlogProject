<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSuperAdminEmailJob;
use Illuminate\Http\Request;
use App\Models\Comments;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class CommentController extends Controller
{
    public function index(){
        $comments = Comments::all();
        return response()->json([
            'status' => true,
            'message' => 'Listing successful',
            'post' => $comments,
        ], 200);
    }

    public function store(Request $request)
    {

        // Kontrol
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'content' => 'required',
        ]);

        // Hata Mesajımı döndürüyorum
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Yeni comment oluşturma
            $comment = new Comments();
            $comment->post_id = $request->post_id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->content = $request->content;
            $comment->save();


        // Super Admin rolünü bul
        $superAdminRole = Role::where('name', 'super_admin')->first();

        // Bu role sahip kullanıcıların e-posta adreslerini bul
        $superAdminEmails = User::role($superAdminRole->name)->pluck('email');

        foreach ($superAdminEmails as $email) {
            SendSuperAdminEmailJob::dispatch($email);
        }
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
