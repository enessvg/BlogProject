<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundMessage;
use App\Models\Agreements;
use Illuminate\Http\Request;

class AgreementsController extends Controller
{
    public function show($slug){
        $agreements = Agreements::where('slug', $slug)->first();

        if (!$agreements) {
            throw new NotFoundMessage('agreement');
        }

        return response()->json([
            'status' => true,
            'agreements' => $agreements,
        ]);

    }
}
