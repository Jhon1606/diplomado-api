<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\AssignmentTrait;

class AssignmentController extends Controller
{
    use AssignmentTrait;

    /**
     * Assingament teacher and course.
     *
     * @param  teacher_id  $teacher_id
     * @param  course_id  $course_id
     * @return \Illuminate\Http\Response
     */
    public function assignment($teacher_id, $course_id)
    {
        try {
            return DB::transaction(function () use ($teacher_id, $course_id) {
                return $this->assignmentTeacherCourse($teacher_id, $course_id);
            });
        } catch (\Throwable $th) {
            return $this->respondServerError($th->getMessage());
        }
    }
}
