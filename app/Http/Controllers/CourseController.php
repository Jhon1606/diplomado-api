<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CourseTrait;
use App\Http\Requests\Course\StoreCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use CourseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            return DB::transaction(function () {
                return $this->courseList();
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
    public function store(StoreCourseRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return $this->courseStore($request);
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
                return $this->courseShow($id);
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
        try {
            return DB::transaction(function () use($request, $id) {
                return $this->courseUpdate($id, $request);
            });
        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
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
        try {
            return DB::transaction(function() use($id) {
                return $this->courseDelete($id);
            });
        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
        //
    }
}
