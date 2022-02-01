<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller{
    //
        public function login(LoginRequest $request){
        
            $input = $request->validated();

        //echo var_dump($input);

            //dd($input);
            
            $credentials = [
                'email'    => $input['email'],
                'password' => $input['password'],
                ];
    
            if (! $token = auth()->attempt($credentials)) {

                //dd($token);
                
                return response()->json(['error' => 'Unauthorized'], 401);

            }
    
            //dd($token);
            //die;

            return $this->respondWithToken($token);
        }
        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }
        
}
