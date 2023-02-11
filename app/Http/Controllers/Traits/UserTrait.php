<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\RestActions;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    use RestActions;

    public function userSignIn($request)
    {
        try {
            if(Auth::attempt($request->only('email','password'))){
                $token = $request->user()->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'token' => $token
                ]);
            }

            return $this->respond(404, [], 'Email o contraseña incorrecta, intenta nuevamente.');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al iniciar sesión.',
                $th->getMessage()
            );
        }
    }

    public function userLogout(){
        try {
            Auth::user()->currentAccessToken()->delete();
            return $this->respond(200, null, 'Sesión cerrada');

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Error al cerrar sesión.',
                $th->getMessage()
            );
        }
    }
}
