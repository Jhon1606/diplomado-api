<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TeacherTrait;
use App\Http\Requests\Teacher\StoreTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    use TeacherTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            return DB::transaction(function () {
                return $this->teacherList();
            });

        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->teacherStore($request);
            });

        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                return $this->teacherShow($id);
            });
        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function internalServerError($th)
    {
        return $this->respond(
            500,
            null,
            'Internal Server Error',
            $th->getMessage()
        );
    }
}
