<?php

namespace App\Http\Controllers;

use App\Models\Kvkk;
use App\Models\Privacy_policy;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function kvkk(){
        $kvkk = Kvkk::get()->first();
        return response()->json([
            'kvkk' => $kvkk,
        ], 200);

    }

    public function privacy_policy(){
        $privacy_policy = Privacy_policy::get()->first();
        return response()->json([
            'privacy_policy' => $privacy_policy,
        ], 200);
    }
}
