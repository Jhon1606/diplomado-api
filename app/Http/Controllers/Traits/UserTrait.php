<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Support\Facades\Auth;

trait UserTrait{
    public function signIn($request){
        try {
            if(Auth::attempt($request->only('email','password'))){
                $token = $request->user()->createToken('token')->plainTextToken;
                return response()->json([
                    'token' => $token
                ],200);
            }

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al iniciar sesión.',
                $th->getMessage()
            );
        }
    }

    public function logout($request){
        try {

           

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al iniciar sesión.',
                $th->getMessage()
            );
        }
    }
}