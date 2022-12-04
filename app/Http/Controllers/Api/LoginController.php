<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {


        // Carbon::now()->addMinutes($min)->timestamp;
        // Carbon::now()-- > addDays(7)->format("Y-m-d H:i:s");

        $data_check = [
            "email" => $request->email,
            "password" => $request->password
        ];


        //b1 xac thuc user co tai khoan hay chua
        if (auth()->attempt($data_check)) {
            // dd(auth()->id());
            $check_token_exist = SessionUser::where("user_id", auth()->id())->first();
            if (empty($check_token_exist)) {
                $user = SessionUser::create([
                    "token" => Str::random(40),
                    "refresh_token" => Str::random(40),
                    "token_expired" => Carbon::now()->addDays(30)->format("Y-m-d H:i:s"),
                    "refresh_token_expired" => Carbon::now()->addDays(360)->format("Y-m-d H:i:s"),
                    "user_id" => auth()->id()

                ]);
            } else {
                $user = $check_token_exist;
            }
            return response()->json([
                "code" => 200,
                "data" => $user


            ], 200);
        } else {
            return response()->json([
                "code" => 401,
                "message" => "username k dung"


            ], 401);
        }
    }


    public function refresh_token(Request $request)
    {

        $token = $request->header("token"); //lay ra header
        $check_token_exist = SessionUser::where("token", $token)->first();
        if (!empty($token)) {
            if ($check_token_exist < Carbon::now()) {
                $check_token_exist->update([
                    "token" => Str::random(40),
                    "refresh_token" => Str::random(40),
                    "token_expired" => Carbon::now()->addDays(30)->format("Y-m-d H:i:s"),
                    "refresh_token_expired" => Carbon::now()->addDays(360)->format("Y-m-d H:i:s"),
                    "user_id" => auth()->id()
                ]);
            }
            $data = SessionUser::find($check_token_exist->id);
            return response()->json([
                "code" => "200",
                "data" => $data,
                "message" => "refresh thanh cong"
            ], 200);
        }
    }


    public function delete_token(Request $request)
    {


        $token = $request->header("token"); //lay ra header
        $check_token_exist = SessionUser::where("token", $token)->first();
        if (!empty($token)) {
            $check_token_exist->delete();

            return response()->json([
                "code" => "200",

                "message" => "delete token thanh cong"
            ], 200);
        }
    }
}
