<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use UserTrait;

    public function login(Request $request){
        try {
           return DB::transaction(function () use($request) {
               return $this->signIn($request);
           });

        } catch (\Throwable $th) {
            return $this->respond(
                500,
                null,
                'Internal server error.',
                $th->getMessage()
            );
        }
    }
}
