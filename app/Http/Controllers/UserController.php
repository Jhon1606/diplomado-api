<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use UserTrait;

    public function login(Request $request)
    {
        try {
           return DB::transaction(function () use($request) {
               return $this->userSignIn($request);
           });

        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }

    public function logout()
    {
        try {
           return DB::transaction(function () {
               return $this->userLogout();
           });

        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }

    public function checkToken()
    {
        try {
            return $this->checkAuthToken();
        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }
}
