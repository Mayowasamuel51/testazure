<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SantumController extends Controller{
    use HttpResponse;

    public function login(LoginUserRequest $request){
        $request->validated($request->all());
        if(!Auth::attempt($request->only(['email','password']))){
            return $this->error('', "inviad users", 401);
        }
        $user = User::where("email", $request->email)->first();
        return $this->success([
            "user"=> $user,
            "token"=> $user->createToken("Api token for ".$user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){
            $request->validated($request->all());
             $user = User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password)
             ]);
             return $this->success([
                "user"=>$user,
                "token"=>$user->createToken('API TOKEN OF'.$user->name)->plainTextToken
             ]);
     
    }

    public function logout(){
         
    }
}
