<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
    //    return $request->all();

        $image_path="";
        if($request->hasFile('avatar')){
            $image_path=$request->file('avatar')->store("images",'public');
        }

        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            'avatar'=>$image_path,
            "phone"=>$request->phone,
            "address"=>$request->address,
            "bio"=>$request->bio,
        ];

       $user = User::create($data);
       $token = $user->createToken("token")->accessToken;

       return responseData($token,"user created",200);
       
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

       try{
        if(!auth()->attempt(["email"=>$request->email,"password"=>$request->password])){
            return response()->json([
                "message"=>"Invalid credentials"
            ],401);
        }
        $token = auth()->user()->createToken("token")->accessToken;
        // $refreshToken = auth()->user()->createToken("token")->refreshToken;
        return response()->json([
            "data"=>[
                "token"=>$token,
                // "refreshToken"=>$refreshToken,
                "user"=>auth()->user()
            ]
            ],200);
       }catch(err){
            return responseData(err,"somthing is wrong",204);
       }
    }

    public function me(Request $request){
        return response()->json([
            "data"=>[
                "user"=>auth()->user()
            ]
            ],200);
    }

    public function users(Request $request){
        $users = User::orderBy("id","desc")->get();
        return response()->json([
            "data"=>[
                "users"=>$users
            ]
        ],200);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            "message"=>"Logged out successfully"
        ],200);
    }
}
