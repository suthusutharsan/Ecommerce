<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userValidation(Request $request){
        $user = DB::table('users')
                ->where('name', $request->name)
                ->where('password', ($request->password))
                ->first();
    
        if($user){
            return response()->json(["message" => "Login Success"]);
        }
        else{
            return response()->json(["message" => "Login Failed"]);
        }
    }
    
    public function productPage(Request $request){
        $data = DB::table('products')
        ->select("title", "quantity","price","image")
        ->orderBy('price', 'asc') 
        ->paginate(5);

        if ($data->count() > 0) {
            return response()->json($data);
        } else {
            return response()->json(["message" => "Not Found"]);
        }
    }
}
