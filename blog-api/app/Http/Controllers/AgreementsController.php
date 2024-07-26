<?php

namespace App\Http\Controllers;

use App\Models\Agreements;
use Illuminate\Http\Request;

class AgreementsController extends Controller
{
    public function show($slug){
        $agreements = Agreements::where('slug', $slug)->first();
        if(!$agreements){
            return response()->json([
               'status' => false,
               'message' => 'The category you are trying to view was not found!'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'agreements' => $agreements,
        ]);

    }
}
