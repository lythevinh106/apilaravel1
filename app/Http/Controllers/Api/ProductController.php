<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        ///cach1: co ban


        ///doan nay nen de o middle ware giong nhu auth
        $token = $request->header("token"); //lay ra header
        $check_token_exist = SessionUser::where("token", $token)->first();

        if (empty($token)) {
            return response()->json([
                "code" => "401",
                "message" => "Banj k gui token len serve"
            ], 401);
        } elseif (empty($check_token_exist)) {
            return response()->json([
                "code" => "401",
                "message" => "Token k hop le"
            ], 401);
        } else {
            return response()->json([
                "code" => "200",
                "data" => Product::all()
            ], 200);
        }
    }
}
