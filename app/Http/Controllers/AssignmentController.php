<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\AssignmentTrait;

class AssignmentController extends Controller
{
    use AssignmentTrait;
    public function assignment($teacher_id,$course_id){
        try {
            return DB::transaction(function () use($teacher_id,$course_id) {
                return $this->assignmentTeacherCourse($teacher_id,$course_id);   
            });
        } catch (\Throwable $th) {
            
        }
    }
}
